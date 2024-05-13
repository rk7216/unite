<!DOCTYPE html>

<!-- index.blade.php -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unite Strategy Builder - Pokemon List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="register-login-buttons" style="text-align: right;">
            @auth
                <span class="mr-4">Welcome, {{ Auth::user()->name }}!</span>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('register') }}" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</a>
                <a href="{{ route('login') }}" class="ml-4 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</a>
            @endauth
        </div>
        <nav class="text-center bg-indigo-600 text-white text-lg py-3">
            <a href="{{ route('posts.index') }}" class="mr-4">Home</a>|
            <a href="{{ route('team.index') }}" class="mx-4">Teams</a>|
            <a href="{{ route('myteam.index') }}" class="mx-4">My Team</a>|
            <a href="{{ route('medal.index') }}" class="ml-4">Medal Set</a>
        </nav>
    </header>


    <main class="container mx-auto mt-8">
        <!-- タイトル -->
        <h1 style="text-center text-4xl font-bold text-indigo-600 mb-6">Unite Strategy Builder</h1>

        <!-- ポケモン一覧表示 -->
        <div class="pokemon-grid grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 xl:grid-cols-10 gap-4">
            @foreach($pokemons as $pokemon)
                <a href="{{ url('/pokemons/' . $pokemon->pokemon_name) }}" class="block p-4 bg-white rounded-lg shadow-lg">
                    <img src="{{ $pokemon->image }}" alt="{{ $pokemon->pokemon_name }}" class="mx-auto" style="width: 100px; height: auto;">
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
