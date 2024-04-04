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
        <!-- Register/Loginボタン -->
        <div class="register-login-buttons" style="text-align: right;">
            <button>Register</button>
            <button>Login</button>
        </div>
        <nav style="text-align: center;">
            <a href="{{ route('posts.index') }}">Home</a> |
            <a href="{{ route('team.index') }}">Teams</a> |
            <a href="{{ route('myteam.index') }}">My Team</a>|
            <a href="{{ route('medal.index') }}">Medal Set</a>
        </nav>
    </header>
    <header>
        <!-- ヘッダーのコンテンツを追加 -->
    </header>

    <main>
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
            <!-- メダルの選択フォームを追加 -->
        </section>

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
                    @foreach($pokemon_levels as $level)
                        <tr>
                            <td>{{ $level->lv }}</td>
                            <td data-stat="hp" data-level="{{ $level->lv }}">{{ $level->hp }}</td>
                            <td data-stat="attack" data-level="{{ $level->lv }}">{{ $level->attack }}</td>
                            <td data-stat="defense" data-level="{{ $level->lv }}">{{ $level->defense }}</td>
                            <td data-stat="sp_attack" data-level="{{ $level->lv }}">{{ $level->sp_attack }}</td>
                            <td data-stat="sp_defense" data-level="{{ $level->lv }}">{{ $level->sp_defense }}</td>
                            <td data-stat="crit_rate" data-level="{{ $level->lv }}">{{ $level->crit_rate }}</td>
                            <td data-stat="cdr" data-level="{{ $level->lv }}">{{ $level->cdr }}</td>
                            <td data-stat="life_steal" data-level="{{ $level->lv }}">{{ $level->life_steal }}</td>
                            <td data-stat="attack_speed" data-level="{{ $level->lv }}">{{ $level->attack_speed }}</td>
                            <td data-stat="move_speed" data-level="{{ $level->lv }}">{{ $level->move_speed }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
    <script src="{{ secure_asset('js/app.js') }}"></script>
</body>
</html>
