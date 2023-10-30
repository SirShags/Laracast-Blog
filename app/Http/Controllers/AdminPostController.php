<?php

namespace App\Http\Controllers;

use App\Models\DraftPost;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index() {
        return view('admin.posts.index', [
            'posts' => Post::orderBy('created_at', 'desc')->paginate(50),
            'drafts' => DraftPost::orderBy('created_at','desc')->paginate(50),
        ]);
    }

    public function create() {
        return view('admin.posts.create');
    }

    public function store(Request $request) {
        $request['user_id'] = auth()->id();

        $attributes = $this->validatePost($request, (new Post()));

        $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        $attributes['thumbnail'] = substr($attributes['thumbnail'], stripos($attributes['thumbnail'], '/') + 1);

        //check to see if user wants to publish the post
        if($request->action == 'create') {
            // if so save to Post table
            Post::create($attributes);
            return back()->with('success', 'Post as been published');
        }

        //otherwise save to draft table
        DraftPost::create($attributes);

        return back()->with('success', 'Post as been saved as a draft');
    }

    public function edit(Post $post) {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post) {
        //set user_id as if only admin can edit posts
        $request['user_id'] = $post->user_id;

        //if multiple users can update posts
        //$request['user_id'] = auth()->id();

        $attributes = $this->validatePost($request, $post);

        if(isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
            $attributes['thumbnail'] = substr($attributes['thumbnail'], stripos($attributes['thumbnail'], '/') + 1);
        }

        //check to see if user wants to publish the post
        if($request->action == 'create') {
            $this->updatePost($post, $attributes);

            return back()->with('success', 'Post as been published');
        }

        $this->updateDraft($post, $attributes);

        return back()->with('success', 'The post has been updated.');
    }

    public function destroy(Post $post) {
        $post->delete();

        return back()->with('success', 'The post has been deleted.');
    }

    protected function validatePost(Request $request, ?Post $post = null) {
        $post ??= new Post();

        if($request->action == 'create') {
            $request['published_at'] = now()->toDateTimeString();
        }

        // ddd($request->all());

        return $request->validate([
            'title'=> ['required'],
            'thumbnail' => $post->exists() ? ['image'] : ['required', 'image'],
            'excerpt' => ['required'],
            'body' => ['required'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'user_id' => ['required', Rule::exists('users','id')],
            'published_at' => $request['publish'] ? ['required'] : ['nullable']
        ]);
    }

    //update the post and delete a draft entry if it exists
    protected function updatePost(Post $post, array $attributes) {
        $attributes['draft_post_id'] = null;

        //update the post to the post table or create a new one
        $post->update($attributes);

        $draft = DraftPost::where('post_id', $post->id)->first();

        if($draft?->exists()) {
            $draft->delete();
        }
    }

    // creating or updating a draft post
    protected function updateDraft(Post $post, array $attributes) {
        // draft foreign key to connect to post table
        $attributes['post_id'] = $post->id;

        // ensure the post already had a thumbnail then set it to the attributes if one wasn't chosen
        if(!isset($attributes['thumbnail']) && isset($post->thumbnail)) {
            $attributes['thumbnail'] = $post->thumbnail;
        }

        // find a draft with the given post id and update it, or create one
        $draft = DraftPost::updateOrCreate(
            ["post_id" => $post->id],
            $attributes
        );

        // update post table to have a draft post foreign key
        $post->update([
            'draft_post_id' => $draft->id
        ]);
    }
}
