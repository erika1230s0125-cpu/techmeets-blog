@extends('layouts.app')

@section('title', $event->title)

@section('content')
    <a href="{{ route('events.index') }}">← 一覧に戻る</a>

    <h1>{{ $event->title }}</h1>

    <table>
        <tr>
            <th>開催日時</th>
            <td>{{ $event->starts_at->format('Y年m月d日 H:i') }}</td>
        </tr>
        <tr>
            <th>会場</th>
            <td>{{ $event->location }}</td>
        </tr>
        <tr>
            <th>説明</th>
            <td>
                @if ($event->description)
                    {!! nl2br(e($event->description)) !!}
                @else
                    説明はありません
                @endif
            </td>
        </tr>
    </table>

    <h2>このイベントを予約する</h2>

    <form method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        @error('event_id')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div>
            <label for="name">名前</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">メールアドレス</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="number_of_people">人数</label><br>
            <input type="number" id="number_of_people" name="number_of_people"
                   min="1" max="10" value="{{ old('number_of_people', 1) }}">
            @error('number_of_people')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="reserved_at">日時</label><br>
            <input type="datetime-local" id="reserved_at" name="reserved_at"
                   value="{{ old('reserved_at', $event->starts_at->format('Y-m-d\TH:i')) }}">
            @error('reserved_at')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">予約する</button>
    </form>

@endsection
