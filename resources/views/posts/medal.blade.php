<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medal Set Creation</title>
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
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>Create Your Medal Set</h1>
        <form id="medalSetForm" action="{{ route('medal.store') }}" method="POST">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            @csrf
            @for ($i = 0; $i < 10; $i++)
                <div class="medal-selection">
                    <label for="medal-select-{{ $i }}">Medal {{ $i + 1 }}:</label>
                    <select name="medals[{{ $i }}][id]" id="medal-select-{{ $i }}" class="medal-select">
                        <option value="">Select a Medal</option>
                        @foreach ($medals as $medal)
                            <option value="{{ $medal->id }}">{{ $medal->medal_name }}</option>
                        @endforeach
                    </select>
                </div>
            @endfor
            <!-- グループ名の入力フィールドを追加 -->
            <div class="form-group">
                <label for="group-name">Group Name:</label>
                <input type="text" name="name" id="group-name" required>
            </div>
            <button type="submit">Submit Medal Set</button>
        </form>
        

        <div id="selectedMedals">
            <h2>Selected Medals</h2>
            @if(session('selectedMedals'))
                <ul>
                    @foreach(session('selectedMedals') as $medalName)
                        <li>{{ $medalName }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div id="medalStats">
            <h2>Medal Stats</h2>
            @if(session('success'))
                @if(session('totalStats'))
                    <div>
                        <ul>
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
        <div id="medalStats">
            @if(session('colorCounts'))
                <div>
                    <h2>Color Counts</h2>
                    <ul>
                        @foreach (session('colorCounts') as $color => $count)
                            <li>{{ $color }}: {{ $count }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <h2>Registered Medal Sets</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medalGroups as $medalGroup)
                <tr>
                    <td>{{ $medalGroup->name }}</td>
                    <td>
                        {{-- 削除フォーム --}}
                        <form method="POST" action="{{ route('medal.destroy', $medalGroup->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                     <td>
                        @foreach ($medalGroup->nonZeroStats as $key => $value)
                            <span>{{ ucfirst($key) }}: {{ $value }}; </span>
                        @endforeach
                    </td>
                    <td>
                        @if ($medalGroup->colorCounts)
                            <ul>
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
</body>
</html>
