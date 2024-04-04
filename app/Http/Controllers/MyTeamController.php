<?php

// MyTeamController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Item;

class MyTeamController extends Controller
{
    public function index()
    {
        // データベースからランダムに5匹のポケモンを取得
        $pokemons = PokeModel::inRandomOrder()->limit(5)->get();
        // アイテムの一覧を取得
        $items = Item::all();

        // ビューにデータを渡す
        return view('posts.myteam', compact('pokemons','items'));
    }
}
