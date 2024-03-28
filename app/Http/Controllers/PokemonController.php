<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // DB クラスを使うために追加

class PokemonController extends Controller
{
    public function index()
    {
        // ポケモンテーブルから一意のポケモン名のリストを取得し、重複を削除
        $pokemons = DB::table('pokemons')->distinct()->pluck('pokemon_name')->toArray();

        // 正しいビューにデータを渡す
        return view('posts.index', compact('pokemons'));
    }
}
