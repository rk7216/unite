<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unite Strategy Builder</title>
    <!-- CSS や JavaScript ファイルをここで読み込む -->
</head>
<body>
    <header>
        <div>
            <!-- ログインボタンと登録ボタンのリンクを追加 -->
            <a href="{{ route('login') }}">ログイン</a>
            <a href="{{ route('register') }}">登録</a>
        </div>
    </header>

    <main>
        <!-- メインコンテンツをここに表示 -->
        @yield('content')
    </main>
</body>
</html>
