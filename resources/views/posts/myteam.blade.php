{{-- resources/views/my_teams.blade.php --}}
<!DOCTYPE html>
<html lang="en">
{{-- myteam.blade.php --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unite Strategy Builder - My Teams</title>
    {{-- スタイルシートのリンク --}}
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
        <h1>Unite Strategy Builder - My Team</h1>
        {{-- チーム名の入力 --}}
        <div>
            <label for="team-name" style="cursor: pointer;">Team Name:</label>
            <input type="text" id="team-name" name="team-name" value="team1" placeholder="Enter your team name">
        </div>
        <div>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Item 1</th>
                    <th>Item 2</th>
                    <th>Item 3</th>
                    <th>HP</th>
                    <th>Attack</th>
                    <th>Defense</th>
                    <th>SP Attack</th>
                    <th>SP Defense</th>
                    <th>Crit Rate</th>
                    <th>CDR</th>
                    <th>Life Steal</th>
                    <th>Attack Speed</th>
                    <th>Move Speed</th>
                    <th>Lv</th>
                </tr>
            @foreach ($pokemons as $pokemon)
                <tr>
                    <td>{{ $pokemon->pokemon_name }}</td>
                    @for ($i = 1; $i <= 3; $i++)
                    <td>
                        <select name="items[{{ $pokemon->id }}][]">
                            <option value="">選択してください</option>
                            @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    @endfor
                    <td>{{ $pokemon->hp }}</td>
                    <td>{{ $pokemon->attack }}</td>
                    <td>{{ $pokemon->defense }}</td>
                    <td>{{ $pokemon->sp_attack }}</td>
                    <td>{{ $pokemon->sp_defense }}</td>
                    <td>{{ $pokemon->crit_rate }}</td>
                    <td>{{ $pokemon->cdr }}</td>
                    <td>{{ $pokemon->life_steal }}</td>
                    <td>{{ $pokemon->attack_speed }}</td>
                    <td>{{ $pokemon->move_speed }}</td>
                    <td>
                        <input type="range" min="1" max="15" value="1" class="slider" id="pokemon-{{ $pokemon->id }}-level">
                    {{-- 画像がある場合は画像を表示 --}}
                    </td>
                @endforeach
            </tr>
        </div>
    </div>
    {{-- 以下、スクリプトや追加のマークアップ --}}
</body>
</html>
