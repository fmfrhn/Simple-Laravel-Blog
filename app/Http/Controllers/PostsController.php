<?php


namespace App\Http\Controllers;
use App\Models\Post;


class PostsController extends Controller
{

   public function index()
   {
      // -belajar 1-
      // $post = new Post;
      // dd(request()->all(),Post::all()[0]->author->name);

      return view('posts', [
         'title' => 'Posts',
         'posts' => Post::latest()->filter(request(['search','category']))->paginate(7)
         // 'posts' => Post::with(['user', 'category'])->latest()->get()
         // 'posts' => Post::all()

      ]);
   }

   
   public function show (Post $post) {
      return view ('post', [
         'title' => 'Single Post',
         'post' => $post
         
      ]);
   }
 }
