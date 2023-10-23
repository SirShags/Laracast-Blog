<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index() {
        return view('admin.posts.index', [
            'posts' => Post::orderBy('created_at', 'desc')->paginate(50)
        ]);
    }

    public function create() {
        return view('admin.posts.create');
    }

    public function store(Request $request) {
        $this->validatePost($request, (new Post()));

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails');

        Post::create($attributes);

        return redirect('/');
    }

    public function edit(Post $post) {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post) {
        $request['slug'] = $post->slug;

        $attributes = $this->validatePost($request, (new Post()));

        if(isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'The post has been updated.');
    }

    public function destroy(Post $post) {
        $post->delete();

        return back()->with('success', 'The post has been deleted.');
    }

    protected public function validatePost(Request $request, ?Post $post = null) {
        $post ??= new Post();

        return $request->validate([
            'title'=> ['required'],
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'excerpt' => ['required'],
            'body' => ['required'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
    }
}
