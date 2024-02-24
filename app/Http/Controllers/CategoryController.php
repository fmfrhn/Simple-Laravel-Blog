<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{

    public function index () {
        $result = Category::all();
        return view ('categoryall',[
            'title'=>'Daftar Kategori',
            'categories'=>Category::all(),
        ]);
    }

    public function show ($slug) {
        $result = Post:: whereHas('Category', function (Builder $query) use($slug){
            $query->where('name', $slug);
        })->filter(request(['search','category']))->get();
       

        return view ('category',[
            'title'=>$slug,
            'posts'=>$result->load('user')
        ]);
    }

}
