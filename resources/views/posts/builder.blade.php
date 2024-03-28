<!DOCTYPE html>
<!-- builder.blade.php -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Details</title>
    <!-- ここにCSSファイルのリンクを追加 -->
</head>
<body>
    <header>
        <!-- ヘッダーのコンテンツを追加 -->
    </header>

    <main>
        <!-- ポケモンの基本情報 -->
        <section>
            <h1>Pokemon Details</h1>
            <h2>{{ $pokemon->pokemon_name }}</h2>
            <!-- ポケモンの画像を表示 -->
        </section>

        <!-- アイテムの選択フォーム -->
        <section>
            <!-- アイテムの選択フォームを追加 -->
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
                            <td>{{ $level->hp }}</td>
                            <td>{{ $level->attack }}</td>
                            <td>{{ $level->defense }}</td>
                            <td>{{ $level->sp_attack }}</td>
                            <td>{{ $level->sp_defense }}</td>
                            <td>{{ $level->crit_rate }}</td>
                            <td>{{ $level->cdr }}</td>
                            <td>{{ $level->life_steal }}</td>
                            <td>{{ $level->attack_speed }}</td>
                            <td>{{ $level->move_speed }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
