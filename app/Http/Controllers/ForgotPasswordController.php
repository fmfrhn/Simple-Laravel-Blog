<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);

            $status = Password::sendResetLink($request->only('email'));

            return $status === Password::RESET_LINK_SENT
                ? back()->with('success', 'Link reset telah dikirim ke email Anda.')
                : back()->with('loginError', 'Gagal mengirim link reset.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Throwable $th) {
            return back()->with('loginError', 'Terjadi kesalahan. Silakan coba lagi nanti.');
        }
    }

    public function showResetForm($token)
    {
        return view('login.reset-password', ['token' => $token, 'title' => 'Reset Password']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                $user->setRememberToken(Str::random(60));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('halamanlogin')->with([
                'success' => 'Password berhasil direset.',
                'title' => 'Login'
            ])
            : back()->with('loginError', value: 'Gagal mereset password.');
    }
}
