<?php

// PokemonItemController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Item;
use App\Models\MedalSet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PokemonItemController extends Controller
{
    public function attachItems(Request $request, $pokemonId)
    {
        $userId = Auth::id(); // ログインしているユーザーID
        $pokemonId = $request->input('pokemon_id');

        $pokemon = PokeModel::findOrFail($pokemonId);
        // アイテムIDを配列で収集
        $medalIds = collect($request->only(
            ['medal_1', 'medal_2', 'medal_3', 'medal_4', 'medal_5', 'medal_6', 'medal_7', 'medal_8', 'medal_9', 'medal_10']))->filter()->values();
        
        // 既存の紐付けを削除
        DB::table('pokemon_medal')->where('pokemon_id', $pokemonId)->delete();

        // 新しい紐付けを追加
        foreach ($medalIds as $medalId) {
            DB::table('pokemon_medal')->insert([
                'pokemon_id' => $pokemonId,
                'medal_id' => $medalId,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $medals = Medal::findMany($medalIds);
        $levels = $pokemon->levels;
    
        // ステータスを加算せず、計算結果のみを準備
        $levelsModified = $levels->map(function ($level) use ($medals) {
            $modifiedLevel = clone $level;
            foreach ($medals as $medal) {
                $modifiedLevel->hp += $medal->hp;
                $modifiedLevel->attack += $medal->attack;
                $modifiedLevel->defense += $medal->defense;
                $modifiedLevel->sp_attack += $medal->sp_attack;
                $modifiedLevel->sp_defense += $medal->sp_defense;
                $modifiedLevel->crit_rate += $medal->crit_rate;
                $modifiedLevel->cdr += $medal->cdr;
                $modifiedLevel->attack_speed += $medal->attack_speed;
                $modifiedLevel->move_speed += $medal->move_speed;
            }
            return $modifiedLevel;
        });
    
        // セッションに保存するか、直接ビューに渡す
        session(['calculatedLevels' => $levelsModified]);
        
        // ここでリダイレクトせず、直接ビューを返しても良い
        return redirect()->route('medal.store', ['pokemon_name' => $pokemon->pokemon_name])
                         ->with('calculatedLevels', $levelsModified)
                         ->with('success', 'Calculation successful.');
    }
}
