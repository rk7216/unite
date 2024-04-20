<?php

// PokemonItemController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Item;
use App\Models\ItemGroup;
use Illuminate\Support\Facades\Auth;


class PokemonItemController extends Controller
{
    public function attachItems(Request $request, $pokemonId)
    {
        if (!Auth::check()) {
            // ログインしていない場合、フラッシュメッセージをセットして同ページに戻る
            return redirect()->back()->with('error', 'You must be logged in to perform this action.');
        }
        
        $userId = Auth::id(); // ログインしているユーザーID
        $pokemonId = $request->input('pokemon_id');

        $pokemon = PokeModel::findOrFail($pokemonId);
        // アイテムIDを配列で収集
        $itemIds = collect($request->only(['item_1', 'item_2', 'item_3']))->filter()->values();
        
        // アイテムグループを作成
        $itemGroup = new ItemGroup();
        $itemGroup->name = "Group for Pokemon {$pokemonId}";
        $itemGroup->user_id = $userId;
        $itemGroup->save();

        // アイテムとアイテムグループの紐付け
        $itemGroup->items()->sync($itemIds);

        // アイテムのデータを取得
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

        // 計算結果をセッションに保存または直接ビューに渡す
        return redirect()->route('pokemon.builder', ['pokemon_name' => $pokemon->pokemon_name])
                         ->with('calculatedLevels', $levelsModified)
                         ->with('success', 'Item group created and stats calculated successfully.');
    }
}