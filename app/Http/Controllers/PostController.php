<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\UpdateSlug;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index() {

        return view('posts.index', [
            'posts' => Post::latest('published_at')->filter(
                request(['search', 'category', 'author'])
            )->paginate(6)->withQueryString(),
        ]);
    }

    public function show(Post $post) {
        $post->incrementReadCount();

        return view('posts.show', [
            'post' => $post
        ]);
    }
}
