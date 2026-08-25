<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $campaigns = Campaign::with('category')
            ->withSum([
                'donations as collected_amount' => function ($query) {
                    $query->where('payment_status', 'paid');
                }
            ], 'amount')
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.campaigns.index',
            compact('campaigns')
        );
    }

    public function create()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.campaigns.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->title),
        ]);

        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'title' => [
                'required',
                'string',
                'max:200',
            ],
            'slug' => [
                'required',
                'string',
                'max:220',
                'unique:campaigns,slug',
            ],
            'short_description' => [
                'required',
                'string',
                'max:500',
            ],
            'description' => [
                'required',
                'string',
            ],
            'thumbnail' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'target_amount' => [
                'required',
                'numeric',
                'min:10000',
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'published',
                    'completed',
                    'inactive',
                ]),
            ],
            'is_featured' => [
                'nullable',
                'boolean',
            ],
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak ditemukan.',
            'title.required' => 'Judul campaign wajib diisi.',
            'slug.unique' => 'Judul campaign tersebut sudah digunakan.',
            'short_description.required' => 'Deskripsi singkat wajib diisi.',
            'short_description.max' => 'Deskripsi singkat maksimal 500 karakter.',
            'description.required' => 'Deskripsi lengkap wajib diisi.',
            'thumbnail.required' => 'Gambar campaign wajib dipilih.',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.mimes' => 'Gambar harus berformat JPG, PNG, atau WEBP.',
            'thumbnail.max' => 'Ukuran gambar maksimal 2 MB.',
            'target_amount.required' => 'Target donasi wajib diisi.',
            'target_amount.min' => 'Target donasi minimal Rp10.000.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
            'status.required' => 'Status campaign wajib dipilih.',
        ]);

        $validated['thumbnail'] = $request
            ->file('thumbnail')
            ->store('campaigns', 'public');

        $validated['created_by'] = Auth::id();
        $validated['is_featured'] = $request->boolean('is_featured');

        Campaign::create($validated);

        return redirect()
            ->route('admin.campaigns.index')
            ->with('success', 'Campaign berhasil ditambahkan.');
    }

    public function edit(Campaign $campaign)
    {
        $categories = Category::where('is_active', true)
            ->orWhere('id', $campaign->category_id)
            ->orderBy('name')
            ->get();

        return view(
            'admin.campaigns.edit',
            compact('campaign', 'categories')
        );
    }

    public function update(
        Request $request,
        Campaign $campaign
    ) {
        $request->merge([
            'slug' => Str::slug($request->title),
        ]);

        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'title' => [
                'required',
                'string',
                'max:200',
            ],
            'slug' => [
                'required',
                'string',
                'max:220',
                Rule::unique('campaigns', 'slug')
                    ->ignore($campaign->id),
            ],
            'short_description' => [
                'required',
                'string',
                'max:500',
            ],
            'description' => [
                'required',
                'string',
            ],
            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'target_amount' => [
                'required',
                'numeric',
                'min:10000',
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'published',
                    'completed',
                    'inactive',
                ]),
            ],
            'is_featured' => [
                'nullable',
                'boolean',
            ],
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($campaign->thumbnail) {
                Storage::disk('public')
                    ->delete($campaign->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('campaigns', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        $campaign->update($validated);

        return redirect()
            ->route('admin.campaigns.index')
            ->with('success', 'Campaign berhasil diperbarui.');
    }

    public function destroy(Campaign $campaign)
    {
        if ($campaign->donations()->exists()) {
            return back()->with(
                'error',
                'Campaign tidak dapat dihapus karena sudah memiliki donasi.'
            );
        }

        if ($campaign->thumbnail) {
            Storage::disk('public')
                ->delete($campaign->thumbnail);
        }

        $campaign->delete();

        return redirect()
            ->route('admin.campaigns.index')
            ->with('success', 'Campaign berhasil dihapus.');
    }
}