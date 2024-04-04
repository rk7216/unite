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
        <!-- Register/Loginボタン -->
        <div class="register-login-buttons" style="text-align: right;">
            <button>Register</button>
            <button>Login</button>
        </div>
        <nav style="text-align: center;">
            <a href="{{ route('posts.index') }}">Home</a> |
            <a href="{{ route('team.index') }}">Teams</a> |
            <a href="{{ route('myteam.index') }}">My Team</a> |
            <a href="{{ route('medal.index') }}">Medal Set</a>
        </nav>
    </header>

    <main>
        <!-- タイトル -->
        <h1  style="text-align: center;">Unite Strategy Builder</h1>

        <!-- ポケモン一覧表示 -->
        <div class="pokemon-grid">
            @foreach($pokemons as $pokemon)
                <div><a href="{{ url('/pokemons/' . $pokemon) }}">{{ $pokemon }}</a></div>
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
