<?php

namespace App\Http\Controllers;


class AboutController extends Controller
{
    
   public function landing() {
    return view('about', [
        "title"=>"About",
        "name"=>"Farhan Maulana",
        "email"=>"dev.farhanmaulana@gmail.com",
        "gambar"=>asset('img/farhan.png')
    ]);
    
   }

}