<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostService
{
    public function __construct(
        private PostRepository $postRepository
    ) {}

    public function createPost(array $data)
    {
        return DB::transaction(function () use ($data) {

            $post = $this->postRepository->create($data);

            Log::info('Post created', ['post_id' => $post->id]);

            return $post;
        });
    }

    public function updatePost(Post $post, array $data)
    {
        return DB::transaction(function () use ($post, $data) {
            $updated = $this->postRepository->update($post, $data);

            Log::info('Post updated', ['post_id' => $updated->id]);

            return $updated;
        });
    }

    public function deletePost(Post $post)
    {
        return DB::transaction(function () use ($post) {
            $this->postRepository->delete($post);
            
            Log::info('Post deleted', ['post_id' => $post->id]);
        });
    }
}
