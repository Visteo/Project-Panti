<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = News::with('author')
            ->when($request->search, function ($query, $search) {
                $query->where(
                    'title',
                    'like',
                    "%{$search}%"
                );
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.news.index',
            compact('news')
        );
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->title),
        ]);

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:200',
            ],
            'slug' => [
                'required',
                'string',
                'max:220',
                'unique:news,slug',
            ],
            'excerpt' => [
                'required',
                'string',
                'max:500',
            ],
            'content' => [
                'required',
                'string',
            ],
            'thumbnail' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'published',
                    'inactive',
                ]),
            ],
        ], [
            'title.required' => 'Judul berita wajib diisi.',
            'slug.unique' => 'Judul berita tersebut sudah digunakan.',
            'excerpt.required' => 'Ringkasan berita wajib diisi.',
            'excerpt.max' => 'Ringkasan maksimal 500 karakter.',
            'content.required' => 'Isi berita wajib diisi.',
            'thumbnail.required' => 'Gambar berita wajib dipilih.',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.mimes' => 'Gambar harus berupa JPG, PNG, atau WEBP.',
            'thumbnail.max' => 'Ukuran gambar maksimal 2 MB.',
            'status.required' => 'Status berita wajib dipilih.',
        ]);

        $validated['thumbnail'] = $request
            ->file('thumbnail')
            ->store('news', 'public');

        $validated['created_by'] = Auth::id();

        $validated['published_at'] =
            $validated['status'] === 'published'
                ? now()
                : null;

        News::create($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $news)
    {
        return view(
            'admin.news.edit',
            compact('news')
        );
    }

    public function update(
        Request $request,
        News $news
    ) {
        $request->merge([
            'slug' => Str::slug($request->title),
        ]);

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:200',
            ],
            'slug' => [
                'required',
                'string',
                'max:220',
                Rule::unique('news', 'slug')
                    ->ignore($news->id),
            ],
            'excerpt' => [
                'required',
                'string',
                'max:500',
            ],
            'content' => [
                'required',
                'string',
            ],
            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'published',
                    'inactive',
                ]),
            ],
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($news->thumbnail) {
                Storage::disk('public')
                    ->delete($news->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('news', 'public');
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] =
                $news->published_at ?? now();
        } else {
            $validated['published_at'] = null;
        }

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        if ($news->thumbnail) {
            Storage::disk('public')
                ->delete($news->thumbnail);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}