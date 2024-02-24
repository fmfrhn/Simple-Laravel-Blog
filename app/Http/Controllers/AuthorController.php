<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class AuthorController extends Controller
{
    
    public function index () {
        $result = User::all();
        return view ('authors',[
            'title'=>'Daftar Author',
            'authors'=>$result,
        ]);
    }
    
    
    public function show ($author) {
        $result = Post:: whereHas('User', function (Builder $query) use($author){
            $query->where('name', $author);
        })->filter(request(['search','author']))->get();
       

        return view ('author',[
            'title'=>$author,
            'posts'=>$result->load('category','user')
        ]);
    }
}
