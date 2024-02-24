<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;


class LoginController extends Controller
{
    public function index (){
        return view ('login.login', [
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

        return back()->with('loginError' ,'Login Failed!');
    }

    public function logout () {
        Auth::logout();
 
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect(route('halamanlogout'));
    }
}
