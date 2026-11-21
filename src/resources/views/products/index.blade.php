@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
    <h1>商品一覧</h1>

    <a href="{{ route('products.create') }}">新規登録</a>

    @if ($products->isEmpty())
        <p>商品がありません</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>カテゴリー</th>
                    <th>価格</th>
                    <th>在庫数</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <a href="{{ route('products.show', $product) }}">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td>{{ $product->category }}</td>
                        <td>{{ number_format($product->price) }}円</td>
                        <td>
                            @if ($product->stock === 0)
                                在庫切れ
                            @else
                                {{ $product->stock }}個
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{ $products->links('pagination::default') }}
@endsection
