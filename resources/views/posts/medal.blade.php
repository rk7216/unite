<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medal Set Creation</title>
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
    <div class="container">
        <h1>Create Your Medal Set</h1>
        <form id="medalSetForm">
            @csrf
            @for ($i = 0; $i < 10; $i++)
                <div class="medal-selection">
                    <label for="medal-select-{{ $i }}">Medal {{ $i + 1 }}:</label>
                    <select name="medals[{{ $i }}][id]" id="medal-select-{{ $i }}" class="medal-select">
                        <option value="">Select a Medal</option>
                        @foreach ($medals as $medal)
                            <option value="{{ $medal->id }}">{{ $medal->medal_name }}</option>
                        @endforeach
                    </select>
                </div>
            @endfor
            <button type="button" onclick="submitMedalSet()">Submit Medal Set</button>
        </form>

        <div id="selectedMedals">
            <h2>Selected Medals</h2>
            <!-- 選択したメダルの一覧をJavaScriptで動的に追加 -->
        </div>

        <div id="medalStats">
            <h2>Medal Stats</h2>
            <!-- メダルステータスの反映結果をJavaScriptで動的に追加 -->
        </div>

        <div id="colorCount">
            <h2>Color Count</h2>
            <!-- 色のカウントをJavaScriptで動的に追加 -->
        </div>
    </div>

    <script>
        function submitMedalSet() {
            // フォームデータから選択されたメダルを取得し、一覧表示とステータス反映を行うロジックを実装
            // この部分は実際の動的な処理をJavaScriptで実装する必要があります。
        }
    </script>
</body>
</html>
