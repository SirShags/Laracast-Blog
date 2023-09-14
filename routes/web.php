<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
    return view('posts', [
        'posts' => Post::all()
    ]);

    // return view('posts', [
    //     'posts' => Post::all()
    // ]);
});

Route::get('posts/{post}', function ($slug) {
    //find a post by its slug and pass it through a view called "posts"
    $post = Post::find($slug);

    return view('post', [
        'post' => $post
    ]);
})->where('post', '[A-z_\-]+'); //using a regular expression, says "look for anything with Capitol or lowercase letters, underscores, or dashes. + means find one or more"