<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Founder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FounderController extends Controller
{
    public function index(Request $request): View
    {
        $founders = Founder::query()
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = $request->string('search')->trim();

                    $query->where(function ($query) use ($search) {
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere(
                                'position',
                                'like',
                                "%{$search}%"
                            );
                    });
                }
            )
            ->when(
                $request->filled('status'),
                function ($query) use ($request) {
                    $query->where(
                        'is_active',
                        $request->status === 'active'
                    );
                }
            )
            ->ordered()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.founders.index',
            compact('founders')
        );
    }

    public function create(): View
    {
        return view('admin.founders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'is_active' => $request->boolean('is_active'),
        ]);

        $validated = $this->validateFounder($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request
                ->file('photo')
                ->store('founders', 'public');
        }

        Founder::create($validated);

        return redirect()
            ->route('admin.founders.index')
            ->with(
                'success',
                'Data pendiri berhasil ditambahkan.'
            );
    }

    public function edit(Founder $founder): View
    {
        return view(
            'admin.founders.edit',
            compact('founder')
        );
    }

    public function update(
        Request $request,
        Founder $founder
    ): RedirectResponse {
        $request->merge([
            'is_active' => $request->boolean('is_active'),
        ]);

        $validated = $this->validateFounder(
            $request,
            $founder
        );

        if ($request->hasFile('photo')) {
            $newPhoto = $request
                ->file('photo')
                ->store('founders', 'public');

            if ($founder->photo) {
                Storage::disk('public')
                    ->delete($founder->photo);
            }

            $validated['photo'] = $newPhoto;
        }

        $founder->update($validated);

        return redirect()
            ->route('admin.founders.index')
            ->with(
                'success',
                'Data pendiri berhasil diperbarui.'
            );
    }

    public function destroy(Founder $founder): RedirectResponse
    {
        if ($founder->photo) {
            Storage::disk('public')
                ->delete($founder->photo);
        }

        $founder->delete();

        return redirect()
            ->route('admin.founders.index')
            ->with(
                'success',
                'Data pendiri berhasil dihapus.'
            );
    }

    private function validateFounder(
        Request $request,
        ?Founder $founder = null
    ): array {
        return $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'position' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'biography' => [
                    'nullable',
                    'string',
                    'max:3000',
                ],

                'photo' => [
                    $founder ? 'nullable' : 'required',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:4096',
                ],

                'joined_year' => [
                    'nullable',
                    'integer',
                    'min:1900',
                    'max:' . now()->year,
                ],

                'instagram_url' => [
                    'nullable',
                    'url',
                    'max:255',
                ],

                'linkedin_url' => [
                    'nullable',
                    'url',
                    'max:255',
                ],

                'display_order' => [
                    'required',
                    'integer',
                    'min:0',
                    'max:999',
                ],

                'is_active' => [
                    'required',
                    'boolean',
                ],
            ],
            [
                'name.required' =>
                    'Nama pendiri wajib diisi.',

                'photo.required' =>
                    'Foto pendiri wajib dipilih.',

                'photo.image' =>
                    'File foto harus berupa gambar.',

                'photo.mimes' =>
                    'Foto harus berformat JPG, PNG, atau WEBP.',

                'photo.max' =>
                    'Ukuran foto maksimal 4 MB.',

                'joined_year.integer' =>
                    'Tahun bergabung harus berupa angka.',

                'joined_year.min' =>
                    'Tahun bergabung tidak valid.',

                'joined_year.max' =>
                    'Tahun bergabung tidak boleh melebihi tahun ini.',

                'instagram_url.url' =>
                    'Alamat Instagram harus berupa URL lengkap.',

                'linkedin_url.url' =>
                    'Alamat LinkedIn harus berupa URL lengkap.',

                'display_order.required' =>
                    'Urutan tampilan wajib diisi.',

                'display_order.integer' =>
                    'Urutan tampilan harus berupa angka.',
            ]
        );
    }
}