<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|max:1000',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['post_id'] = $post->id;

        Comment::create($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'コメントが投稿されました。');
    }

    public function destroy(Comment $comment)
    {
        // 自分のコメントでなければ403（ステップ4と同じ考え方）
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'この操作は許可されていません');
        }

        // 削除する前に、戻り先の投稿を取っておく
        $post = $comment->post;

        $comment->delete();

        return redirect()->route('posts.show', $post)
            ->with('success', 'コメントを削除しました');
    }
}