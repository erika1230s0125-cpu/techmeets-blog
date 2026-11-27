@extends('layouts.blog')

@section('title', 'タスク一覧')

@section('content')
    <h1>タスク一覧</h1>

    <a href="{{ route('tasks.create') }}">新規タスク</a>

    @forelse ($tasks as $task)
        <article>
            <h2>
                <a href="{{ route('tasks.show', $task) }}">
                    {{ $task->title }}
                </a>
            </h2>
            <p>{{ Str::limit($task->description, 100) }}</p>
            <p>期限：{{ $task->due_date ? $task->due_date->format('Y年m月d日') : '期限なし' }}</p>
            <p>完了状態：{{ $task->is_completed ? '完了' : '未完了' }}</p>
            <small>{{ $task->created_at->format('Y年m月d日') }}</small>

        <form method="POST" action="{{ route('tasks.toggle', $task) }}">
            @csrf
            @method('PATCH')
            <button type="submit">完了状態を切り替え</button>
        </form>

        </article>
    @empty
        <p>タスクがありません</p>
    @endforelse

@endsection
