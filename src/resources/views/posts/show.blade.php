@extends('layouts.blog')

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

    @if(auth()->id() === $post->user_id)
    <a href="{{ route('posts.edit', $post) }}">編集する</a>
    <form method="POST" action="{{ route('posts.destroy', $post) }}"
          style="display: inline;"
          data-name="{{ $post->title }}"
          onsubmit="return confirm('「' + this.dataset.name + '」を本当に削除しますか？')">
        @csrf
        @method('DELETE')
        <button type="submit">削除する</button>
    </form>
    @endif

    <h2>コメント</h2>

@forelse ($post->comments as $comment)
    <div>
        <p>{!! nl2br(e($comment->content)) !!}</p>
        <small>{{ $comment->user->name }} ・ {{ $comment->created_at->format('Y年m月d日 H:i') }}</small>
        @if (auth()->id() === $comment->user_id)
    <form method="POST" action="{{ route('comments.destroy', $comment) }}"
          style="display: inline;"
          onsubmit="return confirm('このコメントを削除しますか？')">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>
@endif
    </div>
@empty
    <p>コメントはまだありません</p>
@endforelse

@auth
    <form method="POST" action="{{ route('comments.store', $post) }}">
        @csrf
        <textarea name="content" rows="3">{{ old('content') }}</textarea>
        @error('content')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <button type="submit">コメントする</button>
    </form>
@else
    <p><a href="{{ route('login') }}">ログイン</a>するとコメントできます</p>
@endauth
@endsection
