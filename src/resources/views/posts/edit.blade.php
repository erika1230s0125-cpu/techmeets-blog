@extends('layouts.app')

@section('title', '投稿の編集')

@section('content')
    <h1>投稿の編集</h1>

    <a href="{{ route('posts.show', $post) }}">← 詳細に戻る</a>

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="title">タイトル</label><br>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}">
            @error('title')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category">カテゴリー</label><br>
            <input type="text" id="category" name="category" value="{{ old('category', $post->category) }}">
            @error('category')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="content">本文</label><br>
            <textarea id="content" name="content" rows="10" cols="60">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">更新する</button>
    </form>
@endsection
