<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // BISA DIAKSES ADMIN & KASIR
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    // HANYA DIPROSES JIKA USER ADALAH ADMIN
    public function updateAvatar(Request $request)
    {
        $user = auth()->user();

        // Cek apakah user adalah Admin (role_id = 1)
        $isAdmin = ($user->role_id == 1 || ($user->role && $user->role->id == 1));
        if (!$isAdmin) {
            return redirect()->back()->with('error', 'Kasir tidak memiliki akses untuk mengubah foto profil.');
        }

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}