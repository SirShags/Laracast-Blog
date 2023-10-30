<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

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
Route::get('/', [PostController::class, 'index'])->name('home');

//this method is if you're only grabbing the slug once
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::post('newsletter', NewsletterController::class);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest'); //non-signed in users can reach
Route::post('register', [RegisterController::class, 'store'])->middleware('guest'); //non-signed in users can reach

Route::get('login', [SessionsController::class, 'create'])->middleware('guest'); //non-signed in users can reach
Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest'); //non-signed in users can reach

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth'); //only signed in users can logout

//every route will have the 'can:admin' middleware applied
Route::middleware('can:admin')->group(function () {
    // Route::resource('admin/posts', AdminPostController::class)->except('show');
    Route::post('admin/posts', [AdminPostController::class, 'store']);
    Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    Route::get('admin/posts', [AdminPostController::class, 'index']);
    Route::get('admin/posts/{post:id}/edit', [AdminPostController::class, 'edit']);
    Route::patch('admin/posts/{post:id}', [AdminPostController::class,'update']);
    Route::delete('admin/posts/{post:id}', [AdminPostController::class,'destroy']);
});


// This method uses getRouteKeyName in Post model, use if you are calling slug multiple times
// Route::get('posts/{post}', function (Post $post) {
//     //find a post by its slug and pass it through a view called "posts"
//     return view('post', [
//         'post' => $post
//     ]);
// });

// Route::get('categories/{category:slug}', function (Category $category) {
//     return view('posts', [
//         'posts' => $category->posts,
//         'currentCategory' => $category,
//         'categories' => Category::all(),
//     ]);
// })->name('category');
