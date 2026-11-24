@extends('layouts.blog')

@section('title', 'イベント一覧')

@section('content')
    <h1>イベント一覧</h1>

    @if ($events->isEmpty())
        <p>イベントがありません</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>開催日時</th>
                    <th>イベント名</th>
                    <th>会場</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->starts_at->format('Y年m月d日 H:i') }}</td>
                        <td>
                            <a href="{{ route('events.show', $event) }}">
                                {{ $event->title }}
                            </a>
                        </td>
                        <td>{{ $event->location }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{ $events->links('pagination::default') }}
@endsection
