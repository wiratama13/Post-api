<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','news_content','author', 'categories_id'
    ];

    public function writer() {
        return $this->belongsTo(User::class,'author','id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'categories_id','id');
    }
}
