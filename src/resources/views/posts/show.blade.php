@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <a href="{{ route('posts.index') }}">← 一覧に戻る</a>

    <article>
        <h1>{{ $post->title }}</h1>
        <p>カテゴリー：{{ $post->category }}</p>
        <small>投稿日：{{ $post->created_at->format('Y年m月d日 H:i') }}</small>

        <div>
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>
    <a href="{{ route('posts.edit', $post) }}">編集する</a>
    <form method="POST" action="{{ route('posts.destroy', $post) }}"
          style="display: inline;"
          data-name="{{ $post->title }}"
          onsubmit="return confirm('「' + this.dataset.name + '」を本当に削除しますか？')">
        @csrf
        @method('DELETE')
        <button type="submit">削除する</button>
    </form>
@endsection
