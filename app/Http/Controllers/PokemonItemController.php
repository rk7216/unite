<?php

// PokemonItemController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Item;
use App\Models\MedalSet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // DB ファサードを使用


class PokemonItemController extends Controller
{
    public function attachItems(Request $request, $pokemonId)
    {
        $userId = Auth::id(); // ログインしているユーザーID
        $pokemonId = $request->input('pokemon_id');

        $pokemon = PokeModel::findOrFail($pokemonId);
        // アイテムIDを配列で収集
        $itemIds = collect($request->only(['item_1', 'item_2', 'item_3']))->filter()->values();
        
        // 既存の紐付けを削除
        DB::table('pokemon_item')->where('pokemon_id', $pokemonId)->delete();
    
        // 新しい紐付けを追加
        foreach ($itemIds as $itemId) {
            DB::table('pokemon_item')->insert([
                'pokemon_id' => $pokemonId,
                'item_id' => $itemId,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $items = Item::findMany($itemIds);
        $levels = $pokemon->levels;
    
        // ステータスを加算せず、計算結果のみを準備
        $levelsModified = $levels->map(function ($level) use ($items) {
            $modifiedLevel = clone $level;
            foreach ($items as $item) {
                $modifiedLevel->hp += $item->hp;
                $modifiedLevel->attack += $item->attack;
                $modifiedLevel->defense += $item->defense;
                $modifiedLevel->sp_attack += $item->sp_attack;
                $modifiedLevel->sp_defense += $item->sp_defense;
                $modifiedLevel->crit_rate += $item->crit_rate;
                $modifiedLevel->cdr += $item->cdr;
                $modifiedLevel->attack_speed += $item->attack_speed;
                $modifiedLevel->move_speed += $item->move_speed;
            }
            return $modifiedLevel;
        });
    
        // セッションに保存するか、直接ビューに渡す
        session(['calculatedLevels' => $levelsModified]);
        
        // ここでリダイレクトせず、直接ビューを返しても良い
        return redirect()->route('pokemon.builder', ['pokemon_name' => $pokemon->pokemon_name])
                         ->with('calculatedLevels', $levelsModified)
                         ->with('success', 'Calculation successful.');
    }
}
