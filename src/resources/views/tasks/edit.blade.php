@extends('layouts.blog')

@section('title', 'タスク編集')

@section('content')
    <h1>タスク編集</h1>

    <a href="{{ route('tasks.show', $task) }}">← 詳細に戻る</a>

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="title">タイトル</label><br>
            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}">
            @error('title')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">詳細</label><br>
            <textarea id="description" name="description" rows="10" cols="60">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="due_date">期限</label><br>
            <input type="date" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
            @error('due_date')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">更新する</button>
    </form>
@endsection
