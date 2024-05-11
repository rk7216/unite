<?php

// PokemonBuildController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Item;
use App\Models\MedalGroup;
use App\Models\ItemGroup;
use Illuminate\Support\Facades\Auth;


class PokemonBuildController extends Controller
{
    public function index($pokemon_name)
    {
        // ポケモンテーブルから指定されたポケモン名の詳細データを取得
        $pokemon = PokeModel::where('pokemon_name', $pokemon_name)->first(); // ポケモン情報を取得

        // アイテムの一覧を取得
        $items = Item::all();
        
        // ログインしたユーザーに紐づくメダルセットの一覧を取得
        $medalGroups = MedalGroup::where('user_id', Auth::id())->get();
        
        // ItemGroup モデルからデータを取得
        $itemGroups = ItemGroup::where('user_id', Auth::id())->get();

        // ポケモンの各レベルのステータス情報を取得
        $pokemon_levels = PokeModel::where('pokemon_name', $pokemon_name)->get();

        // データをビューに渡す
        return view('posts.builder', compact('pokemon', 'pokemon_levels', 'items', 'medalGroups', 'itemGroups'));
    }
    
    private function applyStats($levels, $stats)
    {
        foreach ($levels as $level) {
            foreach ($stats as $key => $value) {
                $level->{$key} += $value;
            }
            $level->save();
        }
    }
    
    private function calculateItemStats($items)
    {
        $stats = ['hp' => 0, 'attack' => 0, 'defense' => 0, 'sp_attack' => 0, 'sp_defense' => 0, 'crit_rate' => 0, 'cdr' => 0, 'move_speed' => 0];
        foreach ($items as $item) {
            foreach ($stats as $key => $_) {
                $stats[$key] += $item->{$key};
            }
        }
        return $stats;
    }
    
    public function destroy($id)
    {
        $itemGroup = ItemGroup::find($id);
        if ($itemGroup) {
            $itemGroup->delete();
            return redirect()->route('pokemon.builder', ['pokemon_name' => $pokemon->pokemon_name])->with('success', 'Pokemon updated successfully.');
        } 
    }

}