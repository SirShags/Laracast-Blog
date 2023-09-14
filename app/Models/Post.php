<?php

namespace App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post {
	public $title;
	public $excerpt;
	public $date;
	public $body;
	public $slug;

	public function __construct($title, $excerpt, $date, $body, $slug)
	{
		$this->title = $title;
		$this->excerpt = $excerpt;
		$this->date = $date;
		$this->body = $body;
		$this->slug = $slug;
	}

	
	public static function find($slug) {
		if(! file_exists($path = resource_path("posts/{$slug}.html"))) {
	        throw new ModelNotFoundException();
	    }

	    // $post = cache()->remember("posts.{$slug}", 3600, function () use ($path) {
	    //     return $post = file_get_contents($path);
	    // });
	    return cache()->remember("posts.{slug}", 1200, fn() => file_get_contents($path));
	}

	public static function all() {
		return collect(File::files(resource_path('posts')))
        ->map(function ($file) {
            return YamlFrontMatter::parseFile($file);
        })
        ->map(function ($document) {
            return $posts[] = new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            );
        });
	}
}