<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unite Strategy Builder - Team Builder</title>
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
            <a href="{{ route('team.index') }}" class="mx-4">Teams</a>|
            <a href="{{ route('myteam.index') }}" class="mx-4">My Team</a>|
            <a href="{{ route('medal.index') }}" class="ml-4">Medal Set</a>
        </nav>
    </header>

    <div class="container mx-auto mt-8">
        <main class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center mb-6">Team Configuration</h1>
            <form action="{{ route('team.save') }}" method="post" class="space-y-4">
                @csrf
                <div>
                    <label for="team_name" class="block text-sm font-medium text-gray-700">Team Name:</label>
                    <input type="text" id="team_name" name="team_name" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Set</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Medal Set</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Toggle</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @for ($i = 0; $i < 5; $i++)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="pokemons[]" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Select a Pokemon</option>
                                    @foreach ($pokemons as $pokemon)
                                        <option value="{{ $pokemon->id }}">{{ $pokemon->pokemon_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="item_groups[{{$i}}]" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Select an Item Group</option>
                                    @foreach ($itemGroups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="medal_groups[{{$i}}]" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Select a Medal Set</option>
                                    @foreach ($medalGroups as $medalgroup)
                                        <option value="{{ $medalgroup->id }}">{{ $medalgroup->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                    <button type="button" class="status-toggle text-indigo-600 hover:text-indigo-900 bg-white border border-indigo-600 hover:bg-indigo-50 focus:ring-4 focus:ring-indigo-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center" data-index="{{$i}}">Toggle Status</button>
                            </td>
                        </tr>
                        @endfor
                    </table>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Team</button>
                <div class="container">
                    @if(session('success'))
                        <div class="alert alert-success mt-4 p-4 bg-green-100 border border-green-400 text-green-700">
                            {{ session('success') }}
                            <h3 class="font-bold">{{ session('teamName') }}</h3>
                            @foreach (session('teamDetails') as $detail)
                                <div>
                                    <img src="{{ $detail['pokemon']->image }}" alt="{{ $detail['pokemon']->pokemon_name }}" style="width: 100px; height: 100px;">
                                    @foreach ($detail['items'] as $item)
                                        <img src="{{ $item->image }}" alt="{{ $item->name }}" style="width: 100px; height: 100px;">
                                    @endforeach
                                    @foreach ($detail['medals'] as $medal)
                                        <img src="{{ $medal->image }}" alt="{{ $medal->name }}" style="width: 100px; height: 100px;">
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </form>
        </main>
    </div>
</body>
</html>
