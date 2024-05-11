<?php

// PokemonItemController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Item;
use App\Models\ItemGroup;
use App\Models\MedalGroup;
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
        $medalGroupId = $request->input('medal_group_id');
        $pokemon = PokeModel::findOrFail($pokemonId);
        $medalGroup = MedalGroup::findOrFail($medalGroupId);

        // アイテムIDを配列で収集
        $itemIds = collect($request->only(['item_1', 'item_2', 'item_3']))->filter()->values();
        $itemGroupName = $request->input('item_group_name', "Default Item Group"); // フォームから入力された名前を取得、デフォルト値設定
        
        // アイテムグループを作成
        $itemGroup = new ItemGroup();
        $itemGroup->name = $itemGroupName; // ここでアイテムグループ名をセット
        $itemGroup->user_id = $userId;
        $itemGroup->save();
        
        // アイテムとアイテムグループの紐付け
        $itemGroup->items()->sync($itemIds);

        // アイテムのデータを取得
        $items = Item::findMany($itemIds);
        $medals = $medalGroup->medals;

        $pokemon_levels = PokeModel::where('pokemon_name', $pokemon->pokemon_name)->get(); // 同じ名前のポケモン（異なるレベル）を取得

        $calculatedLevels = [];
        foreach ($pokemon_levels as $level) {
            $calculated = [
                'lv' => $level->lv,
                'hp' => $level->hp,
                'attack' => $level->attack,
                'defense' => $level->defense,
                'sp_attack' => $level->sp_attack,
                'sp_defense' => $level->sp_defense,
                'crit_rate' => $level->crit_rate,
                'cdr' => $level->cdr,
                'life_steal' => $level->life_steal,
                'attack_speed' => $level->attack_speed,
                'move_speed' => $level->move_speed
            ];
            foreach ($items as $item) {
                $calculated['hp'] += $item->hp;
                $calculated['attack'] += $item->attack;
                $calculated['defense'] += $item->defense;
                $calculated['sp_attack'] += $item->sp_attack;
                $calculated['sp_defense'] += $item->sp_defense;
                $calculated['crit_rate'] += $item->crit_rate;
                $calculated['cdr'] += $item->cdr;
                $calculated['attack_speed'] += $item->attack_speed;
                $calculated['move_speed'] += $item->move_speed;
            }
            foreach ($medals as $medal) {
                $calculated['hp'] += $medal->hp;
                $calculated['attack'] += $medal->attack;
                $calculated['defense'] += $medal->defense;
                $calculated['sp_attack'] += $medal->sp_attack;
                $calculated['sp_defense'] += $medal->sp_defense;
                $calculated['crit_rate'] += $medal->crit_rate;
                $calculated['cdr'] += $medal->cdr;
                $calculated['attack_speed'] += $medal->attack_speed;
                $calculated['move_speed'] += $medal->move_speed;
            }
            $calculatedLevels[] = $calculated;
        }

        return redirect()->route('pokemon.builder', [
            'pokemon_name' => $pokemon->pokemon_name,
            'levels' => json_encode($calculatedLevels)
        ])->with('success', 'Item group and medal set applied created and stats calculated successfully.');
    }
}