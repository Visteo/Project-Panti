<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::firstOrCreate(
            [],
            [
                'organization_name' => 'Harapan Bangsa',
                'tagline' => 'Berbagi Kebaikan, Menumbuhkan Harapan',
            ]
        );

        return view(
            'admin.settings.edit',
            compact('setting')
        );
    }

    public function update(Request $request)
    {
        $setting = Setting::firstOrCreate(
            [],
            [
                'organization_name' => 'Harapan Bangsa',
            ]
        );

        $validated = $request->validate([
            'organization_name' => [
                'required',
                'string',
                'max:150',
            ],

            'tagline' => [
                'nullable',
                'string',
                'max:200',
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'about' => [
                'nullable',
                'string',
            ],

            'vision' => [
                'nullable',
                'string',
                'max:3000',
            ],

            'mission' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'about_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'email' => [
                'nullable',
                'email',
                'max:150',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:30',
            ],

            'instagram' => [
                'nullable',
                'url',
                'max:255',
            ],

            'bca_account_number' => [
                'nullable',
                'string',
                'max:50',
            ],

            'bca_account_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'bri_account_number' => [
                'nullable',
                'string',
                'max:50',
            ],

            'bri_account_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'mandiri_account_number' => [
                'nullable',
                'string',
                'max:50',
            ],

            'mandiri_account_name' => [
                'nullable',
                'string',
                'max:150',
            ],
        ], [
            'organization_name.required' =>
                'Nama organisasi wajib diisi.',

            'logo.image' =>
                'Logo harus berupa gambar.',

            'logo.mimes' =>
                'Logo harus berformat JPG, PNG, atau WEBP.',

            'logo.max' =>
                'Ukuran logo maksimal 2 MB.',

            'email.email' =>
                'Format email tidak valid.',

            'instagram.url' =>
                'Alamat Instagram harus berupa URL lengkap.',

            'hero_image.image' =>
                'Gambar hero harus berupa gambar.',

            'hero_image.mimes' =>
                'Gambar hero harus berformat JPG, PNG, atau WEBP.',

            'hero_image.max' =>
                'Ukuran gambar hero maksimal 5 MB.',

            'about_image.image' =>
                'Foto tentang yayasan harus berupa gambar.',

            'about_image.mimes' =>
                'Foto tentang yayasan harus berformat JPG, PNG, atau WEBP.',

            'about_image.max' =>
                'Ukuran foto tentang yayasan maksimal 5 MB.',
        ]);

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')
                    ->delete($setting->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('settings', 'public');
        }

        if ($request->hasFile('hero_image')) {
            $newHeroImage = $request
                ->file('hero_image')
                ->store('settings/hero', 'public');

            if ($setting->hero_image) {
                Storage::disk('public')
                    ->delete($setting->hero_image);
            }

            $validated['hero_image'] = $newHeroImage;
        }

        if ($request->hasFile('about_image')) {
            $newAboutImage = $request
                ->file('about_image')
                ->store('settings/about', 'public');

            if ($setting->about_image) {
                Storage::disk('public')
                    ->delete($setting->about_image);
            }

            $validated['about_image'] = $newAboutImage;
        }

        $setting->update($validated);

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }
}