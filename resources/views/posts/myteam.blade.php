{{-- resources/views/my_teams.blade.php --}}
<!DOCTYPE html>
<html lang="en">
{{-- myteam.blade.php --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unite Strategy Builder - My Teams</title>
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

    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-center mb-6">Unite Strategy Builder - My Team</h1>
        {{-- チーム名の入力 --}}
        <div class="container">
        <h1>My Teams</h1>
        
        @foreach ($teams as $team)
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h2 class="text-xl font-semibold mb-4">{{ $team->team_name }}</h2>
                <form action="{{ route('myteam.destroy', $team->id) }}" method="POST" class="mb-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this team?');" class="text-red-600 hover:text-red-800">Delete Team</button>
                </form>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th>Pokemon</th>
                                <th>Lv Changes</th>
                                <th>Item Group</th>
                                <th>Medal Set</th>
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
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($team->userPokemons as $userPokemon)
                                @php
                                    $sessionData = session('updatedPokemons.' . $userPokemon->id);
                                    $currentLevel = $sessionData ? $sessionData['pokemonData']->lv : $userPokemon->pokemon->lv;
                                @endphp
                                <tr>
                                    <td>
                                        <!-- Display Pokemon image -->
                                        <img src="{{ $sessionData ? $sessionData['pokemonData']->image : $userPokemon->pokemon->image }}" alt="{{ $userPokemon->pokemon->pokemon_name }}" style="width: 100px; height: auto;">
                                    </td>
                                    <td>
                                        <form action="{{ route('myteam.updateLevel', ['userPokemonId' => $userPokemon->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="pokemon_name" value="{{ $userPokemon->pokemon->pokemon_name }}">
                                            <select name="level" onchange="this.form.submit()">
                                                @for ($i = 1; $i <= 15; $i++)
                                                    <option value="{{ $i }}" {{ $i == $currentLevel ? 'selected' : '' }}>Level {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        @foreach ($userPokemon->itemGroupMedalGroup->itemGroup->items->take(3) as $item)
                                            <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-12 h-12 m-1">
                                        @endforeach
                                    </td>
                                    <td class="flex flex-wrap">
                                        @foreach ($userPokemon->itemGroupMedalGroup->medalGroup->medals->take(10) as $medal)
                                            <img src="{{ $medal->image }}" alt="{{ $medal->name }}" class="w-12 h-12 m-1">
                                        @endforeach
                                    </td>
                                    <td>{{ $sessionData ? $sessionData['modifiedStats']['hp'] : $userPokemon->modifiedStats['hp'] }}</td>
                                    <td>{{ $sessionData ? $sessionData['modifiedStats']['attack'] : $userPokemon->modifiedStats['attack'] }}</td>
                                    <td>{{ $sessionData ? $sessionData['modifiedStats']['defense'] : $userPokemon->modifiedStats['defense'] }}</td>
                                    <td>{{ $sessionData ? $sessionData['modifiedStats']['sp_attack'] : $userPokemon->modifiedStats['sp_attack'] }}</td>
                                    <td>{{ $sessionData ? $sessionData['modifiedStats']['sp_defense'] : $userPokemon->modifiedStats['sp_defense'] }}</td>
                                    <td>{{ $sessionData ? $sessionData['modifiedStats']['crit_rate'] : $userPokemon->modifiedStats['crit_rate'] }}</td>
                                    <td>{{ $sessionData ? $sessionData['modifiedStats']['cdr'] : $userPokemon->modifiedStats['cdr'] }}</td>
                                    <td>{{ $sessionData ? $sessionData['modifiedStats']['life_steal'] : $userPokemon->modifiedStats['life_steal'] }}</td>
                                    <td>{{ $sessionData ? $sessionData['modifiedStats']['attack_speed'] : $userPokemon->modifiedStats['attack_speed'] }}</td>
                                    <td>{{ $sessionData ? $sessionData['modifiedStats']['move_speed'] : $userPokemon->modifiedStats['move_speed'] }}</td>
                                    <td>{{ $sessionData ? $sessionData['modifiedStats']['lv'] : $userPokemon->pokemon->lv }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
