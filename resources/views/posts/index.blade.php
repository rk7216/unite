<!DOCTYPE html>

<!-- index.blade.php -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unite Strategy Builder - Pokemon List</title>
    <link href="{{ asset('/resources/css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <div class="register-login-buttons" style="text-align: right;">
            @auth
                {{-- ログインしている場合、ユーザー名とログアウトボタンを表示 --}}
                <span class="mr-4">Welcome, {{ Auth::user()->name }}!</span>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                {{-- ログインしていない場合、RegisterとLoginボタンを表示 --}}
                <a href="{{ route('register') }}" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</a>
                <a href="{{ route('login') }}" class="ml-4 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</a>
            @endauth
        </div>
        <nav style="text-align: center;">
            <a href="{{ route('posts.index') }}" class="mr-4">Home</a>|
            <a href="{{ route('team.index') }}" class="mx-4">Teams</a>|
            <a href="{{ route('myteam.index') }}" class="mx-4">My Team</a>|
            <a href="{{ route('medal.index') }}" class="ml-4">Medal Set</a>
        </nav>
    </header>


    <main>
        <!-- タイトル -->
        <h1  style="text-align: center;">Unite Strategy Builder</h1>

        <!-- ポケモン一覧表示 -->
        <div class="pokemon-grid">
            @foreach($pokemons as $pokemon)
                <a href="{{ url('/pokemons/' . $pokemon->pokemon_name) }}">
                    <img src="{{ $pokemon->image }}" alt="{{ $pokemon->pokemon_name }}" style="width: 100px; height: auto;">
                </a>
            @endforeach
        </div>

        <!-- ポケモン/チーム作成画面へのリンク -->
        <div>
            <!-- リンクのコードをここに追加 -->
        </div>

        <!-- チーム一覧画面へのリンク -->
        <div>
            <!-- リンクのコードをここに追加 -->
        </div>
    </main>
</body>
</html>
