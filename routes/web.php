<?php

use App\Http\Controllers\PostCommentsController;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Spatie\YamlFrontMatter\YamlFrontMatter;
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

Route::post('newsletter', function() {
    request()->validate([
        'email' => ['required', 'email']
    ]);

    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us21'
    ]);

    // $response = $mailchimp->ping->get();

    try {
        $response = $mailchimp->lists->addListMember('586df8c645', [
            'email_address' => request('email'),
            'status' => 'subscribed'
        ]);
    } catch (\Exception $e) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => 'This email could not be added to our newsletter list.'
        ]);
    }

    return redirect('/')->with('success', 'You are now signed up for our newsletter!');
});

Route::get('/', [PostController::class, 'index'])->name('home');

//this method is if you're only grabbing the slug once
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest'); //non-signed in users can reach
Route::post('register', [RegisterController::class, 'store'])->middleware('guest'); //non-signed in users can reach

Route::get('login', [SessionsController::class, 'create'])->middleware('guest'); //non-signed in users can reach
Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest'); //non-signed in users can reach

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth'); //only signed in users can logout

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
