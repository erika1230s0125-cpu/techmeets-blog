@extends('layouts.app')

@section('title', '新規投稿')

@section('content')
    <h1>新規投稿</h1>

    <a href="{{ route('posts.index') }}">← 一覧に戻る</a>

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <div>
            <label for="title">タイトル</label><br>
            <input type="text" id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category">カテゴリー</label><br>
            <input type="text" id="category" name="category" value="{{ old('category') }}">
            @error('category')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="content">本文</label><br>
            <textarea id="content" name="content" rows="10" cols="60">{{ old('content') }}</textarea>
            @error('content')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">投稿する</button>
    </form>
@endsection
