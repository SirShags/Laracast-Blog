<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post {
	public static function find($slug) {
		if(! file_exists($path = resource_path("posts/{$slug}.html"))) {
	        throw new ModelNotFoundException();
	    }

	    // $post = cache()->remember("posts.{$slug}", 3600, function () use ($path) {
	    //     return $post = file_get_contents($path);
	    // });
	    return cache()->remember("posts.{slug}", 1200, fn() => file_get_contents($path));
	}
}