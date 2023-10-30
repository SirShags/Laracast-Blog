<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    /**
     * Opposite of $fillable, assigns variables that are not mass assignable
     */
    // protected $guarded = [];
    // protected $with = ['category', 'author'];

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array<string, text>
    //  */
    // protected $fillable = [
    //     'title',
    //     'slug',
    //     'excerpt',
    //     'body',
    //     'category_id',
    // ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function draftPost() {
        return $this->hasOne(DraftPost::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function author() { //foreign key is called author_id
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Summary of sluggable
     * @return array
     */
    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function scopeFilter($query, array $filters) { //Post::newQuery()->filter()
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where(fn($query) =>
             $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
                ->orWhere('excerpt', 'like', '%' . $search . '%')
            )
        );
        $query->when($filters['category'] ?? false, fn ($query, $category) =>
            $query
                ->whereHas('category', fn($query) =>
                    $query->where('slug', $category)
                )
        );
        $query->when($filters['author'] ?? false, fn ($query, $author) =>
            $query
                ->whereHas('author', fn($query) =>
                    $query->where('username', $author)
                )
        );
    }
}
