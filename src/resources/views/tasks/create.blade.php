@extends('layouts.blog')

@section('title', '新規タスク')

@section('content')
    <h1>新規タスク</h1>

    <a href="{{ route('tasks.index') }}">← 一覧に戻る</a>

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div>
            <label for="title">タイトル</label><br>
            <input type="text" id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">詳細</label><br>
            <textarea id="description" name="description" rows="10" cols="60">{{ old('description') }}</textarea>
            @error('description')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="due_date">期限</label><br>
            <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}">
            @error('due_date')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">追加する</button>
    </form>
@endsection
