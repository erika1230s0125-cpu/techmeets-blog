<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - My App</title>
</head>
<body>
    <header>
        <nav>
        @auth
    <span>{{ auth()->user()->name }} さん</span>
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
       @else
    <a href="{{ route('login') }}">ログイン</a>
    <a href="{{ route('register') }}">新規登録</a>
        @endauth
            <a href="/">ホーム</a>
            <a href="/posts">投稿一覧</a>
            <a href="/products">商品一覧</a>
            <a href="/events">イベント一覧</a>
            <a href="/reservations">予約一覧</a>
        </nav>
    </header>

    <main>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        © 2025 My App
    </footer>
</body>
</html>