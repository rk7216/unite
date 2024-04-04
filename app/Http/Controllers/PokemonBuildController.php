<?php

// PokemonBuildController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Item;

class PokemonBuildController extends Controller
{
    public function index($pokemon_name)
    {
        // ポケモンテーブルから指定されたポケモン名の詳細データを取得
        $pokemon = PokeModel::where('pokemon_name', $pokemon_name)->first(); // ポケモン情報を取得

        // アイテムの一覧を取得
        $items = Item::all();
        
        // ポケモンが存在しない場合はエラーを返すか、リダイレクトなどの適切な処理を行う
        if (!$pokemon) {
            abort(404); // 404エラーを返す
        }

        // ポケモンの各レベルのステータス情報を取得
        $pokemon_levels = PokeModel::where('pokemon_name', $pokemon_name)->get();

        // データをビューに渡す
        return view('posts.builder', compact('pokemon', 'pokemon_levels', 'items'));
    }
}
