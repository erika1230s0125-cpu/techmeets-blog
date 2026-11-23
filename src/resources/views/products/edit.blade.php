@extends('layouts.blog')

@section('title', '商品の編集')

@section('content')
    <h1>商品の編集</h1>

    <a href="{{ route('products.show', $product) }}">← 詳細に戻る</a>

    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">商品名</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}">
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category">カテゴリー</label><br>
            <input type="text" id="category" name="category" value="{{ old('category', $product->category) }}">
            @error('category')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price">価格（円）</label><br>
            <input type="number" id="price" name="price" min="0" value="{{ old('price', $product->price) }}">
            @error('price')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock">在庫数</label><br>
            <input type="number" id="stock" name="stock" min="0" value="{{ old('stock', $product->stock) }}">
            @error('stock')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">説明（任意）</label><br>
            <textarea id="description" name="description" rows="5" cols="60">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">更新する</button>
    </form>
@endsection
