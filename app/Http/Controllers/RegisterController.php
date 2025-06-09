<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.newregister', [
            'title' => 'Register'
        ]);
    }


    public function registrasi(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:50|min:5',
                'username' => ['required', 'max:12', 'min:5', 'regex:/^\S+$/'],
                // 'profile_image' => 'image|file|max:2024|nullable', 
                'profile_image' => 'image|file|nullable', 
                'email' => 'required|email:dns|unique:users',
                'password' => 'required|min:4|max:20|confirmed',
            ]);

            if ($request->hasFile('profile_image')) {
                $validatedData['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
            }

            $validatedData['password'] = bcrypt($validatedData['password']);

            unset($validatedData['password_confirmation']);

            User::create($validatedData);

            return redirect(route('halamanlogin'))->with('success', 'Registrasi berhasil!!');
        } catch (Exception $e) {
            return redirect(route('halamanregister'))
                ->with('loginError', $e->getMessage())
                ->withInput();
        }
    }

}
