<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unite Strategy Builder - Team Builder</title>
    <!-- ここにスタイルシートやJavaScriptのリンクを追加 -->
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
        <main>
            <h1>Team Configuration</h1>
            <form action="#" method="post"> <!-- 適切なアクションに変更してください -->
                @csrf
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Item 1</th>
                        <th>Item 2</th>
                        <th>Item 3</th>
                        <th>Battle Item</th>
                        <th>Medal Set</th>
                        <th>Status Toggle</th> <!-- ステータス表示切り替え -->
                    </tr>
                    @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td>
                            <select name="pokemons[]">
                                <option value="">Select a Pokemon</option>
                                @foreach ($pokemons as $pokemon)
                                    <option value="{{ $pokemon->id }}">{{ $pokemon->pokemon_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        @for ($j = 1; $j <= 3; $j++)
                            <td>
                                <select name="items[{{$i}}][{{$j}}]">
                                    <option value="">Select an Item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        @endfor
                        <td>
                            <select name="battle_items[{{$i}}]">
                                <option value="">Select a Battle Item</option>
                                @php
                                    $battleItems = ['Eject Button', 'Fluffy Tail', 'Full Heal', 'Goal Getter', 'Potion', 'Slow Smoke', 'X Attack', 'X Speed', 'Shedinja Doll'];
                                @endphp
                                @foreach ($battleItems as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="medals[{{$i}}]">
                                <option value="">Select a Medal Set</option>
                                @foreach ($medals as $medal)
                                    <option value="{{ $medal->id }}">{{ $medal->medal_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <!-- ここにステータス表示切り替えの準備。具体的なJS/CSSは後ほど -->
                            <button type="button" class="status-toggle" data-index="{{$i}}">Toggle Status</button>
                        </td>
                    </tr>
                    @endfor
                </table>
                <button type="submit">Save Team</button>
            </form>
        </main>
    </div>
</body>
</html>
