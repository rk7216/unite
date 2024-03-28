
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon List</title>
    <link href="{{ asset('/resources/css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <!-- ログイン/登録ボタン -->
        <div>
            <!-- ボタンのコードをここに追加 -->
        </div>
    </header>

    <main>
        <!-- ポケモン一覧表示 -->
        <div class="pokemon-grid">
            @foreach($pokemons as $pokemon)
                <div>{{ $pokemon }}</div>
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
