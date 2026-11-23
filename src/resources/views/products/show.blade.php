@extends('layouts.blog')

@section('title', $product->name)

@section('content')
    <a href="{{ route('products.index') }}">← 一覧に戻る</a>

    <h1>{{ $product->name }}</h1>

    <table>
        <tr>
            <th>カテゴリー</th>
            <td>{{ $product->category }}</td>
        </tr>
        <tr>
            <th>価格</th>
            <td>{{ number_format($product->price) }}円</td>
        </tr>
        <tr>
            <th>在庫数</th>
            <td>
                @if ($product->stock === 0)
                    在庫切れ
                @else
                    {{ $product->stock }}個
                @endif
            </td>
        </tr>
        <tr>
            <th>説明</th>
            <td>
                @if ($product->description)
                    {!! nl2br(e($product->description)) !!}
                @else
                    説明はありません
                @endif
            </td>
        </tr>
        <tr>
            <th>登録日</th>
            <td>{{ $product->created_at->format('Y年m月d日 H:i') }}</td>
        </tr>
    </table>

    <a href="{{ route('products.edit', $product) }}">編集する</a>

    <form method="POST" action="{{ route('products.destroy', $product) }}"
          style="display: inline;"
          data-name="{{ $product->name }}"
          onsubmit="return confirm('「' + this.dataset.name + '」を本当に削除しますか？')">
        @csrf
        @method('DELETE')
        <button type="submit">削除する</button>
    </form>

@endsection
