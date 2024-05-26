<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unite Strategy Builder - Medal Set Creation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .medal-image {
            width: 80px;
            height: 80px;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .selected {
            border: 2px solid blue;
        }
    </style>
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
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="text-3xl font-bold text-center mb-6">Create Your Medal Set</h1>
        <!-- <div class="flex justify-center mb-4">
            <label for="colorFilter" class="block text-sm font-medium text-gray-700 mr-2">Filter by Color:</label>
            <select id="colorFilter" class="mt-1 block w-1/3 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">All</option>
                <option value="Black">Black</option>
                <option value="Blue">Blue</option>
                <option value="Brown">Brown</option>
                <option value="Gray">Gray</option>
                <option value="Green">Green</option>
                <option value="Navy">Navy</option>
                <option value="Pink">Pink</option>
                <option value="Purple">Purple</option>
                <option value="Red">Red</option>
                <option value="White">White</option>
                <option value="Yellow">Yellow</option>
            </select>
        </div> -->
        
        <form id="medalSetForm" action="{{ route('medal.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf
            <input type="hidden" name="medals" id="selectedMedalsInput">
            <input type="hidden" name="name" id="group-name-input" required>
            
            <div id="medal-images" class="flex flex-wrap justify-center mb-4">
                @foreach ($medals as $medal)
                    <div class="m-2">
                        <img src="{{ $medal->image }}" alt="{{ $medal->medal_name }}" class="medal-image" data-medal-id="{{ $medal->id }}">
                    </div>
                @endforeach
            </div>
            
            <div class="mb-4">
                <label for="group-name" class="block text-sm font-medium text-gray-700">Group Name:</label>
                <input type="text" name="name" id="group-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-lg">Submit Medal Set</button>
        </form>
        

        <div id="selectedMedals" class="mt-6">
            <h2 class="text-2xl font-bold mb-4">Selected Medals</h2>
            @if(session('selectedMedals'))
                <ul class="list-disc pl-5">
                    @foreach(session('selectedMedals') as $medalName)
                        <li>{{ $medalName }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div id="medalStats" class="mt-6">
            <h2 class="text-2xl font-bold mb-4">Medal Stats</h2>
            @if(session('success'))
                @if(session('totalStats'))
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <ul class="list-disc pl-5">
                            <li>HP: {{ session('totalStats')['hp'] }}</li>
                            <li>Attack: {{ session('totalStats')['attack'] }}</li>
                            <li>Defense: {{ session('totalStats')['defense'] }}</li>
                            <li>Sp.Attack: {{ session('totalStats')['sp_attack'] }}</li>
                            <li>Sp.Defense: {{ session('totalStats')['sp_defense'] }}</li>
                            <li>Crit Rate: {{ session('totalStats')['crit_rate'] }}</li>
                            <li>CDR: {{ session('totalStats')['cdr'] }}</li>
                            <li>Move Speed: {{ session('totalStats')['move_speed'] }}</li>
                        </ul>
                    </div>
                @endif
            @endif

        </div>
        <div id="medalStats" class="mt-6">
            @if(session('colorCounts'))
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">Color Counts</h2>
                    <ul class="list-disc pl-5">
                        @foreach (session('colorCounts') as $color => $count)
                            <li>{{ $color }}: {{ $count }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <h2 class="text-2xl font-bold text-center my-6">Registered Medal Sets</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($medalGroups as $medalGroup)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-bold mb-2">{{ $medalGroup->name }}</div>
                        <div class="flex flex-wrap -mx-1">
                            @foreach ($medalGroup->getAllMedalImagesUrls() as $imageUrl)
                                <div class="px-1">
                                    <img src="{{ $imageUrl }}" alt="Medal Image" class="w-12 h-12">
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{-- 削除フォーム --}}
                        <form method="POST" action="{{ route('medal.destroy', $medalGroup->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @foreach ($medalGroup->nonZeroStats as $key => $value)
                            <span>{{ ucfirst($key) }}: {{ $value }}; </span>
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($medalGroup->colorCounts)
                            <ul class="list-disc list-inside">
                                @foreach ($medalGroup->colorCounts as $color => $count)
                                    <li>{{ $color }}: {{ $count }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const medalImages = document.querySelectorAll('.medal-image');
            const selectedMedalsInput = document.getElementById('selectedMedalsInput');
            const groupNameInput = document.getElementById('group-name-input');
            const form = document.getElementById('medalSetForm');
            const colorFilter = document.getElementById('colorFilter');
            const medalItems = document.querySelectorAll('.medal-item');
            
            let selectedMedals = [];

            medalImages.forEach(img => {
                img.addEventListener('click', () => {
                    const medalId = img.getAttribute('data-medal-id');
                    if (selectedMedals.includes(medalId)) {
                        selectedMedals = selectedMedals.filter(id => id !== medalId);
                        img.classList.remove('selected');
                    } else {
                        if (selectedMedals.length < 10) {
                            selectedMedals.push(medalId);
                            img.classList.add('selected');
                        } else {
                            alert('You can select up to 10 medals only.');
                        }
                    }
                    selectedMedalsInput.value = JSON.stringify(selectedMedals);
                });
            });

            form.addEventListener('submit', (e) => {
                const groupName = document.getElementById('group-name').value;
                groupNameInput.value = groupName;
            });

            colorFilter.addEventListener('change', () => {
                const selectedColor = colorFilter.value.toLowerCase();
                medalItems.forEach(item => {
                    const color1 = item.getAttribute('data-color1').toLowerCase();
                    const color2 = item.getAttribute('data-color2').toLowerCase();
                    if (!selectedColor || color1 === selectedColor || color2 === selectedColor) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
