<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    public function __construct(
        private PostService $postService,
        private PostRepository $postRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postRepository->getAll();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:200',
            'category' => 'required|max:50',
            'content' => 'required',
        ]);

        $validated['user_id'] = auth()->id();

        $post = $this->postService->createPost($validated);

        return redirect()->route('posts.index')
            ->with('success', '投稿を作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        Gate::authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        Gate::authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|max:200',
            'category' => 'required|max:50',
            'content' => 'required',
        ]);

        $post = $this->postService->updatePost($post, $validated);

        return redirect()->route('posts.show', $post)
            ->with('success', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $this->postService->deletePost($post);

        return redirect()->route('posts.index')
            ->with('success', '投稿を削除しました');
    }
}
