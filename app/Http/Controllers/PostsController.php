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
         'posts' => Post::latest()->filter(request(['search', 'category']))->paginate(9)
         // 'posts' => Post::with(['user', 'category'])->latest()->get()
         // 'posts' => Post::all()

      ]);
   }


   public function show(Post $post)
   {
      $post->increment('views');

      return view('post', [
         'title' => 'Single Post',
         'post' => $post,
      ]);
   }

   public function toggleLike(Post $post)
   {
      $user = auth()->user();

      if ($post->isLikedBy($user)) {
         $post->likes()->detach($user->id); // unlike
      } else {
         $post->likes()->attach($user->id); // like
      }

      return back();
   }

}
