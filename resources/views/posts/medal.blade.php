<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medal Set Creation</title>
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

    <div class="container">
        <h1>Create Your Medal Set</h1>
        <form id="medalSetForm" action="{{ route('medal.store') }}" method="POST">
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
            <button type="submit">Submit Medal Set</button>
        </form>

        <div id="selectedMedals">
            <h2>Selected Medals</h2>
            @if(session('selectedMedals'))
                <h2>Selected Medals</h2>
                <ul>
                    @foreach(session('selectedMedals') as $medal)
                        <li>{{ $medal->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div id="medalStats">
            <h2>Medal Stats</h2>
            @if(session('medalStats'))
                <h2>Medal Stats</h2>
                <ul>
                    <li>HP: {{ session('medalStats.hp') }}</li>
                    <li>Attack: {{ session('medalStats.attack') }}</li>
                    <li>Defense: {{ session('medalStats.defense') }}</li>
                    <li>Sp.Attack: {{ session('medalStats.sp_attack') }}</li>
                    <li>Sp.Defense: {{ session('medalStats.sp_defense') }}</li>
                    <li>Crit Rate: {{ session('medalStats.crit_rate') }}</li>
                    <li>CDR: {{ session('medalStats.cdr') }}</li>
                    <li>Move_speed: {{ session('medalStats.move_speed') }}</li>
                </ul>
            @endif
            </div>
        <div id="colorCount">
            <h2>Color Count</h2>
            @if(session('colorCount'))
                <h2>Color Count</h2>
                <ul>
                    @foreach(session('colorCount') as $color => $count)
                        <li>{{ $color }}: {{ $count }}</li>
                    @endforeach
                </ul>
            @endif
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
