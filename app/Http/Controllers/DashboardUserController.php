<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardUserController extends Controller
{
    public function userSetting()
    {
        $user = Auth::user();
        return view('dashboard.posts.user-setting', [
            'title' => 'Pengaturan Akun',
            'user' => $user
        ]);
    }

    public function userUpdatePasswordForm()
    {
        $user = Auth::user();
        return view('dashboard.posts.user-update-password', [
            'title' => 'Perbarui Kata Sandi',
            'user' => $user
        ]);
    }

    public function updatePassword()
    {
        $user = Auth::user();

        $validated = request()->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!password_verify($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
        }

        $user->update(['password' => bcrypt($validated['new_password'])]);

        Auth::logout();

        return redirect()->route('login')->with('success', 'Kata sandi berhasil diperbarui. Silakan login kembali.');
    }

    public function userUpdateForm()
    {
        $user = Auth::user();
        return view('dashboard.posts.user-update', [
            'title' => 'Perbarui Akun',
            'user' => $user
        ]);
    }

    public function updateUser(Request $request)
    {
        try {
            $user = Auth::user();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            ]);

            if ($request->hasFile('profile_image')) {
                // Hapus file lama
                if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                    Storage::delete('public/' . $user->profile_image);
                }

                $path = $request->file('profile_image')->store('profile_images', 'public');
                $validated['profile_image'] = $path;
            }

            $user->update($validated);

            return back()->with('success', 'Profil berhasil diperbarui.');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()]);
        }

    }
}
