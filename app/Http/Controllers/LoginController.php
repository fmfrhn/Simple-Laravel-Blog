<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;


class LoginController extends Controller
{
    public function index (){
        return view ('login.newlogin', [
            'title'=>'Login'
        ]);
    }

    public function autentikasi (Request $request){
        $credentials= $request->validate([
            'username'=> 'required|min:5|max:20',
            'password'=>'required|min:4|max:20'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))->with('success','login berhasil!');
        }

        return back()->with('loginError' ,'Credentials did not match our record!');
    }

    public function forgotPassword(){
        return view('login.forgot-password', [
            'title' => 'Forgot Password'
        ]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Logic to handle password reset (e.g., sending a reset link)
        
        // This is just a placeholder for demonstration purposes
        return back()->with('status', 'Password reset link sent to your email.');
    }

    public function logout () {
        Auth::logout();
 
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect(route('halamanblog'));
    }
}
