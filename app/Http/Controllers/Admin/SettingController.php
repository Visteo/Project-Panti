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

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
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

        $setting->update($validated);

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }
}