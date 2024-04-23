<?php

// PokemonController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;

class PokemonController extends Controller
{
    public function index()
    {
        // エロクアントを使用してポケモン名の一意のリストを取得
        $pokemons = PokeModel::where('lv', 1)->get();

        // ビューにデータを渡す
        return view('posts.index', ['pokemons' => $pokemons]);
    }
    
}