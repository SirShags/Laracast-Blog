<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Opposite of $fillable, assigns variables that are not mass assignable
     */
    protected $guarded = [];

    protected $with = ['category', 'author'];

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

    public function category() {
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    public function author() { //foreign key is called author_id
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName() {
        return 'slug';
    }
}
