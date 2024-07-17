<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function bookmarks()
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'post_id');
    }

}
