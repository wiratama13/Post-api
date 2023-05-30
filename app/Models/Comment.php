<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id','user_id','comments_content'
    ];

    // public function comment() {
    //     return $this->belongsTo(Post::class,'post_id');
    // }

    public function userComment(){
        return $this->belongsTo(User::class,'user_id');
    }
}
