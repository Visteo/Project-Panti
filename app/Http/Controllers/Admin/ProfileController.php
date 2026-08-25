<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $authenticatedUser = $request->user();

        abort_unless(
            $authenticatedUser instanceof User,
            401
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:150',

                Rule::unique('users', 'email')
                    ->ignore($authenticatedUser->id),
            ],

            'current_password' => [
                'nullable',
                'required_with:password',
                'current_password',
            ],

            'password' => [
                'nullable',
                'confirmed',

                Password::min(8)
                    ->mixedCase()
                    ->numbers(),
            ],
        ], [
            'name.required' =>
                'Nama admin wajib diisi.',

            'email.required' =>
                'Email admin wajib diisi.',

            'email.email' =>
                'Format email tidak valid.',

            'email.unique' =>
                'Email tersebut sudah digunakan.',

            'current_password.required_with' =>
                'Password saat ini wajib diisi untuk mengganti password.',

            'current_password.current_password' =>
                'Password saat ini tidak sesuai.',

            'password.confirmed' =>
                'Konfirmasi password baru tidak sesuai.',
        ]);

        $authenticatedUser->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $authenticatedUser->update([
                'password' => Hash::make(
                    $validated['password']
                ),
            ]);
        }

        return redirect()
            ->route('admin.profile.edit')
            ->with(
                'success',
                'Profil admin berhasil diperbarui.'
            );
    }
}