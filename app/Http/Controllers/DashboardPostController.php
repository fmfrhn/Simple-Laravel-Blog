<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function main()
    {
        $user = Auth::user();

        $posts = Post::where('user_id', $user->id)->with('category')->latest()->get();

        $monthlyPostCount = $posts->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();

        $totalPostCount = $posts->count();

        $postsByCategory = $posts->groupBy(fn($post) => $post->category->name ?? 'Tanpa Kategori')
            ->map(fn($group) => $group->count());

        $recentPosts = $posts->take(5);

        $averageWordCount = round($posts->avg(function ($post) {
            return str_word_count(strip_tags($post->body));
        }));

        $totalViews = $posts->sum('views');

        $monthlyViews = $posts->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->sum('views');

        $averageViews = round($posts->avg('views'));

        $topViewedPosts = $posts->sortByDesc('views')->take(5);




        return view('dashboard.dashboard', [
            'title' => 'Dashboard',
            'posts' => $posts,
            'monthlyPostCount' => $monthlyPostCount,
            'totalPostCount' => $totalPostCount,
            'postsByCategory' => $postsByCategory,
            'recentPosts' => $recentPosts,
            'averageWordCount' => $averageWordCount,
            'totalViews' => $totalViews,
            'monthlyViews' => $monthlyViews,
            'averageViews' => $averageViews,
            'topViewedPosts' => $topViewedPosts,
        ]);
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $posts = Post::query()
            ->with('category', 'user')
            ->when(!$user->is_admin, function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhereHas('category', function ($q2) use ($search) {
                            $q2->where('name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.posts.index', compact('posts'));
    }

    public function exportPdf(Request $request)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $posts = Post::query()
            ->with('category', 'user')
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                $query->whereBetween('created_at', [$start_date, $end_date]);
            })
            ->latest()
            ->get();

        $pdf = Pdf::loadView('pdf.post-pdf', compact('posts', 'start_date', 'end_date'));
        return $pdf->download('laporan-posts.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'image' => 'image|file|max:1024',
            'category_id' => 'required',
            'body' => 'required'
        ]);

        // jika ada gambarnya, ambil. jika tidak ada ambil dari api unsplash
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Post::create($validatedData);

        return redirect()->route('dashboard.post.index')->with('success', 'Postingan Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Post::where('id', $post->id)->update($validatedData);

        return redirect()->route('dashboard.post.index')->with('success', 'Postingan Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image);
        }

        $post->delete();
        // Post::destroy($post->id);

        return redirect()->route('dashboard.post.index')->with('success', 'Postingan Berhasil dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug, 'var1' => 'satu', 'var2' => 'dua']);
    }
}
