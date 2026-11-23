@extends('layouts.blog')

@section('title', '予約一覧')

@section('content')
    <h1>予約一覧</h1>

    @if ($reservations->isEmpty())
        <p>予約がありません</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>イベント</th>
                    <th>日時</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>人数</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>
                            <a href="{{ route('events.show', $reservation->event) }}">
                                {{ $reservation->event->title }}
                            </a>
                        </td>
                        <td>{{ $reservation->reserved_at->format('Y年m月d日 H:i') }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->email }}</td>
                        <td>{{ $reservation->number_of_people }}人</td>
                        <td>
                            <form method="POST" action="{{ route('reservations.destroy', $reservation) }}"
                                  data-name="{{ $reservation->event->title }}"
                                  onsubmit="return confirm('「' + this.dataset.name + '」の予約をキャンセルしますか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">キャンセル</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{ $reservations->links('pagination::default') }}
@endsection
