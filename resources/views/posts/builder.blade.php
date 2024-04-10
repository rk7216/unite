<!DOCTYPE html>
<!-- builder.blade.php -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Details</title>
    <!-- ここにCSSファイルのリンクを追加 -->
    <link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">
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

    <header>
        <!-- ヘッダーのコンテンツを追加 -->
    </header>

    <main>
        <form action="{{ route('pokemon.attach-items', ['pokemon_name' => $pokemon->pokemon_name]) }}" method="POST">
            @csrf
            @method('POST') {{-- LaravelでPUT/PATCH/DELETEリクエストを行う場合に必要ですが、POSTを使用する場合はこの行は不要です --}}

            <!-- ユーザーIDの送信 (必要に応じて) -->
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        
            <!-- ポケモンIDの送信 -->
            <input type="hidden" name="pokemon_id" value="{{ $pokemon->id }}">

            <!-- ポケモンの基本情報 -->
            <section>
                <h1>Status Calculator</h1>
                <h2>{{ $pokemon->pokemon_name }}</h2>
                <!-- ポケモンの画像を表示 -->
            </section>
            <!-- アイテムの選択フォーム -->
            <section>
                <!-- アイテムの選択フォームを追加 -->
                <h3>Select Items</h3>
                @for ($i = 0; $i < 3; $i++)
                    <select name="item_{{ $i + 1 }}" class="item-select">
                        <option value="">Select an item</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}"
                                data-hp="{{ $item->hp ?? '' }}"
                                data-attack="{{ $item->attack ?? '' }}"
                                data-defense="{{ $item->defense ?? '' }}"
                                data-sp_attack="{{ $item->sp_attack ?? '' }}"
                                data-sp_defense="{{ $item->sp_defense ?? '' }}"
                                data-crit_rate="{{ $item->crit_rate ?? '' }}"
                                data-cdr="{{ $item->cdr ?? '' }}"
                                data-attack_speed="{{ $item->attack_speed ?? '' }}"
                                data-move_speed="{{ $item->move_speed ?? '' }}">
                                {{ $item->item_name }}
                            </option>
                        @endforeach
                    </select>
                @endfor
            </section>
            
    
            <!-- メダルの選択フォーム -->
            <section>
                <h3>Select Medal Set</h3>
                <select name="medal_set" class="medal-set-select">
                    <option value="">Select a Medal Set</option>
                    @foreach ($medalsets as $medalset)
                        <option value="{{ $medalset->id }}">{{ $medalset->name }}</option>
                    @endforeach
                </select>
            </section>
            
            <button type="submit" class="btn btn-primary">Save Changes</button>
            {{-- フラッシュメッセージの表示 --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ポケモンのレベルごとのステータス -->
            <section>
                <h2>Pokemon Status</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Level</th>
                            <th>HP</th>
                            <th>Attack</th>
                            <th>Defense</th>
                            <th>Sp.Attack</th>
                            <th>Sp.Defense</th>
                            <th>Crit Rate</th>
                            <th>CDReduction</th>
                            <th>Life Steal</th>
                            <th>Attack Speed</th>
                            <th>Move Speed</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- セッションデータがある場合はそのデータを使用し、ない場合はデフォルトのデータを使用 --}}
                        @php
                            $levelsToDisplay = session('calculatedLevels', $pokemon_levels);
                        @endphp
                        @foreach($levelsToDisplay as $level)
                            <tr>
                                <td>{{ $level->lv }}</td>
                                <td>{{ $level->hp }}</td>
                                <td>{{ $level->attack }}</td>
                                <td>{{ $level->defense }}</td>
                                <td>{{ $level->sp_attack }}</td>
                                <td>{{ $level->sp_defense }}</td>
                                <td>{{ $level->crit_rate }}</td>
                                <td>{{ $level->cdr }}</td>
                                <td>{{ $level->life_steal }}</td>
                                <td>{{ $level->attack_speed}}</td>
                                <td>{{ $level->move_speed }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        {{-- サブミットボタン --}}
        </form>
    </main>
    <script src="{{ secure_asset('js/app.js') }}"></script>
</body>
</html>
