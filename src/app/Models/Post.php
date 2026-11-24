<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category',
        'user_id',
    ];

    // この投稿に付いたコメント（投稿はたくさんのコメントを持つ）
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
