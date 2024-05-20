<!DOCTYPE html>
<!-- builder.blade.php -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unite Strategy Builder - Pokemon Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="register-login-buttons" style="text-align: right;">
            @auth
                <span class="mr-4">Welcome, {{ Auth::user()->name }}!</span>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('register') }}" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</a>
                <a href="{{ route('login') }}" class="ml-4 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</a>
            @endauth
        </div>
        <nav class="text-center bg-indigo-600 text-white text-lg py-3">
            <a href="{{ route('posts.index') }}" class="mr-4">Home</a>|
            <a href="{{ route('items.create') }}" class="mx-4">Item Group</a>|
            <a href="{{ route('medal.index') }}" class="mx-4">Medal Group</a>|
            <a href="{{ route('team.index') }}" class="mx-4">Teams</a>|
            <a href="{{ route('myteam.index') }}" class="ml-4">My Team</a>
        </nav>
    </header>

    @if (session('error'))
        <div class="alert alert-danger max-w-md mx-auto mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
    
    @if (session('success'))
        <div class="alert alert-success max-w-md mx-auto mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
            @if(session('itemGroup'))
                <h3 class="font-bold">Item Group: {{ session('itemGroup')->name }}</h3>
                <div class="flex">
                    @foreach(session('items') as $item)
                        <div class="mr-4">
                            <img src="{{ $item->image }}" alt="{{ $item->item_name }}" class="w-16 h-16">
                        </div>
                    @endforeach
                </div>
            @endif
            @if(session('medals')->isNotEmpty())
                <h3 class="font-bold mt-4">Medal Group</h3>
                <div class="flex">
                    @foreach(session('medals') as $medal)
                        <div class="mr-4">
                            <img src="{{ $medal->image }}" alt="{{ $medal->name }}" class="w-8 h-8">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif


    <main>
        <form action="{{ route('pokemon.attach-items', ['pokemon_name' => $pokemon->pokemon_name]) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf
            @method('POST') {{-- LaravelでPUT/PATCH/DELETEリクエストを行う場合に必要ですが、POSTを使用する場合はこの行は不要です --}}

            <!-- ユーザーIDの送信 (必要に応じて) -->
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        
            <!-- ポケモンIDの送信 -->
            <input type="hidden" name="pokemon_id" value="{{ $pokemon->id }}">

            <!-- ポケモンの基本情報 -->
            <section>
                <h1 class="text-2xl font-bold text-center mb-4">Status Calculator</h1>
                <h2 class="text-center"><img src="{{ $pokemon->image }}" alt="{{ $pokemon->pokemon_name }}" class="w-24 h-auto mx-auto" style="width: 100px; height: auto;"></h2>
                <!-- ポケモンの画像を表示 -->
            </section>
            <!-- アイテムの選択フォーム -->
            <section>
                <!-- アイテムの選択フォームを追加 -->
                <h3 class="font-semibold mb-2">Select Items</h3>
                @for ($i = 0; $i < 3; $i++)
                    <select name="item_{{ $i + 1 }}" class="item-select mb-4 p-2 bg-gray-200 rounded">
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
                <h3 class="font-semibold mb-2">Select Medal Group</h3>
                <select name="medal_group_id" id="medal-group-select" class="item-select mb-4 p-2 bg-gray-200 rounded">
                    <option value="">Select a Medal Group</option>
                    @foreach ($medalGroups as $medalGroup)
                        <option value="{{ $medalGroup->id }}">
                            {{ $medalGroup->name }}
                        </option>
                    @endforeach
                </select>
            </section>
            
            <form action="{{ route('pokemon.attach-items', ['pokemon_name' => $pokemon->pokemon_name]) }}" method="POST">
                @csrf
                <!-- フォームの内容 -->
                <input type="text" name="item_group_name" placeholder="Enter item group name" required class="mb-4 p-2 bg-gray-200 rounded">
                <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Save Changes</button>
            </form>
            
            {{-- フラッシュメッセージの表示 --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </form>
        <form>
            <!-- ポケモンのレベルごとのステータス -->
            <section>
                <h2 class="text-2xl font-bold text-center my-4">Pokemon Status</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">HP</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attack</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Defense</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sp.Attack</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sp.Defense</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Crit Rate</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CDReduction</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Life Steal</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attack Speed</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Move Speed</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $levelsToDisplay = request('levels') ? json_decode(request('levels'), true) : $pokemon_levels;
                        @endphp
                        @foreach($levelsToDisplay as $level)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $level['lv'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $level['hp'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $level['attack'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $level['defense'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $level['sp_attack'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $level['sp_defense'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $level['crit_rate'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $level['cdr'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $level['life_steal'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $level['attack_speed'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $level['move_speed'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
            @if (auth()->check() && $itemGroups->count() > 0)
                <!-- Item Groups Table -->
                <section class="mt-8">
                    <h2 class="text-2xl font-bold text-center mb-4">Item Groups</h2>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="p-4 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase">Name</th>
                                <th class="p-4 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase">Item 1</th>
                                <th class="p-4 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase">Item 2</th>
                                <th class="p-4 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase">Item 3</th>
                                <th class="p-4 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemGroups as $group)
                                <tr>
                                    <td class="p-4 border-b border-gray-300">{{ $group->name }}</td>
                                    @php $items = $group->items; @endphp
                                    @for ($i = 0; $i < 3; $i++)
                                        <td class="p-4 border-b border-gray-300">
                                            @if (isset($items[$i]))
                                                <img src="{{ $items[$i]->image }}" alt="{{ $items[$i]->name }}" style="width: 50px; height: auto;">
                                            @else
                                                <span class="text-gray-500">未登録</span>
                                            @endif
                                        </td>
                                    @endfor
                                    <td class="p-4 border-b border-gray-300">
                                        <form action="{{ route('itemGroups.destroy', ['id' => $group->id, 'pokemon_name' => $pokemon->pokemon_name]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            @else
                <!-- Message for non-logged in users or no item groups -->
                <p>You need to log in to view your item groups, or no item groups available.</p>
            @endif
        {{-- サブミットボタン --}}
        </form>
    </main>
    <script src="{{ secure_asset('js/app.js') }}"></script>
</body>
</html>
