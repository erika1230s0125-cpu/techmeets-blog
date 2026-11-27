@extends('layouts.blog')

@section('title', $task->title)

@section('content')
    <a href="{{ route('tasks.index') }}">← 一覧に戻る</a>

    <article>
        <h1>{{ $task->title }}</h1>
        <small>作成日：{{ $task->created_at->format('Y年m月d日 H:i') }}</small>
        <p>期限：{{ $task->due_date ? $task->due_date->format('Y年m月d日') : '期限なし' }}</p>
        <p>完了状態：{{ $task->is_completed ? '完了' : '未完了' }}</p>

        <div>
            {!! $task->description ? nl2br(e($task->description)) : '詳細はありません' !!}
        </div>
    </article>

    <a href="{{ route('tasks.edit', $task) }}">編集する</a>
    <form method="POST" action="{{ route('tasks.destroy', $task) }}"
          style="display: inline;"
          data-name="{{ $task->title }}"
          onsubmit="return confirm('「' + this.dataset.name + '」を本当に削除しますか？')">
        @csrf
        @method('DELETE')
        <button type="submit">削除する</button>
    </form>

@endsection
