<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unite Strategy Builder - Create Item Group</title>
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

    <main class="max-w-4xl mx-auto mt-8">
        @if (session('error'))
            <div class="alert alert-danger max-w-md mx-auto mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
        
        @if (session('success'))
            <div class="alert alert-success max-w-md mx-auto mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('items.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf

            <section>
                <h1 class="text-2xl font-bold text-center mb-4">Create Item Group</h1>
                <div class="mb-4">
                    <label for="item_group_name" class="block text-sm font-medium text-gray-700">Item Group Name</label>
                    <input type="text" name="item_group_name" id="item_group_name" class="mt-1 p-2 bg-gray-200 rounded w-full" required>
                </div>
            </section>

            <section>
                <h3 class="font-semibold mb-2">Select Items</h3>
                @for ($i = 0; $i < 3; $i++)
                    <select name="item_{{ $i + 1 }}" class="item-select mb-4 p-2 bg-gray-200 rounded w-full">
                        <option value="">Select an item</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->item_name }}
                            </option>
                        @endforeach
                    </select>
                @endfor
            </section>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Item Group</button>
        </form>

        @if ($userItemGroups->isNotEmpty())
            <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-center mb-4">Your Item Groups</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="p-4 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase">Name</th>
                            <th class="p-4 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase">Items</th>
                            <th class="p-4 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userItemGroups as $group)
                            <tr>
                                <td class="p-4 border-b border-gray-300">{{ $group->name }}</td>
                                <td class="p-4 border-b border-gray-300">
                                    <div class="flex space-x-2">
                                        @foreach ($group->items as $item)
                                            <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-12 h-12">
                                        @endforeach
                                    </div>
                                </td>
                                <td class="p-4 border-b border-gray-300">
                                    <form action="{{ route('itemGroups.destroy', ['id' => $group->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>

    <script src="{{ secure_asset('js/app.js') }}"></script>
</body>
</html>
