<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'user_id',
        'post_id',
    ];

 // コメントを書いたユーザー（コメントは1人のユーザーに属する）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // コメントが付いている投稿（コメントは1つの投稿に属する）
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
