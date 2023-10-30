<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftPost extends Model
{
    use Sluggable;
    use HasFactory;

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }
}
