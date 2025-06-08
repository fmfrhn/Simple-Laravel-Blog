<?php

use App\Http\Controllers\DashboardPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('halamanblog');
});

Route::get('/about', [AboutController::class, 'landing'])->name('halamanabout');

Route::get('/beranda', [HomeController::class, 'show'])->name('halamanhome');

Route::get('/blog', [PostsController::class, 'index'])->name('halamanblog');

Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('kategori');

Route::get('/categories', [CategoryController::class, 'index'])->name('kategoriall');

Route::get('/posts/{post:slug}', [PostsController::class, 'show'])->name('postdetail');

Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('author');

Route::get('/authors', [AuthorController::class, 'index'])->name('authors');

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('halamanlogin')->middleware('guest');
    Route::post('/login-proses', [LoginController::class, 'autentikasi'])->name('autentikasi');
    Route::post('/beranda', [LoginController::class, 'logout'])->name('halamanlogout');
    Route::post('/forgot-password/send', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot-password.send');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password.update');
    Route::get('/register', [RegisterController::class, 'index'])->name('halamanregister')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'registrasi'])->name('registrasi');

});

Route::get('/dashboard', function () {
    return view('dashboard.dashboard', [
        'title' => 'Dashboard'
    ]);
})->name('dashboard')->middleware('auth');

Route::get('dashboard/posts/check-slug', [DashboardPostController::class, 'checkSlug'])->name('dashboard.post.checkslug')->middleware('auth');

Route::resource('dashboard/posts', DashboardPostController::class, [
    'names' => [
        'show' => 'dashboard.post.show',
        'edit' => 'dashboard.post.edit',
        'update' => 'dashboard.post.update',
        'index' => 'dashboard.post.index',
        'create' => 'dashboard.post.create',
        'destroy' => 'dashboard.post.destroy'
    ]
])->middleware('auth');

Route::resource('/dashboard/categories', AdminCategoryController::class, [
    'names' => [
        'index' => 'administrator.category.index',
        'create' => 'administrator.category.create'
    ]
])->except('show')->middleware('admin');





//halaman single post

// Route::get('/posts/{slug}', function ($slug){
//     return view ('post',[
//         'title' => 'Single Post',
//         'post'
//     ]);
// });



