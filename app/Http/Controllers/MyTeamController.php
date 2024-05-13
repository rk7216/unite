<?php

// MyTeamController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Team;
use App\Models\UserPokemon;
use App\Models\ItemGroup;
use App\Models\MedalGroup;

class MyTeamController extends Controller
{

    public function index(Request $request)
    {
        $user_id = auth()->id();  // 認証されたユーザーのIDを取得
        $level = $request->query('level', 1);  // デフォルトはレベル1

        $teams = Team::with(['userPokemons' => function ($query) use ($level) {
                    $query->whereHas('pokemon', function ($q) use ($level) {
                        $q->where('lv', $level);  // ポケモンのlvを基にフィルタリング
                    });
                }, 'userPokemons.pokemon', 'userPokemons.itemGroupMedalGroup.itemGroup', 'userPokemons.itemGroupMedalGroup.medalGroup'])
                ->where('user_id', $user_id)
                ->get();
        foreach ($teams as $team) {
            foreach ($team->userPokemons as $userPokemon) {
                $baseStats = [
                    'hp' => $userPokemon->pokemon->hp,
                    'attack' => $userPokemon->pokemon->attack,
                    'defense' => $userPokemon->pokemon->defense,
                    'sp_attack' => $userPokemon->pokemon->sp_attack,
                    'sp_defense' => $userPokemon->pokemon->sp_defense,
                    'crit_rate' => $userPokemon->pokemon->crit_rate,
                    'life_steal' => $userPokemon->pokemon->life_steal,
                    'cdr' => $userPokemon->pokemon->cdr,
                    'attack_speed' => $userPokemon->pokemon->attack_speed,
                    'move_speed' => $userPokemon->pokemon->move_speed,
                    'lv' => $userPokemon->pokemon->lv,

                ];
                $items = $userPokemon->itemGroupMedalGroup->itemGroup->items;
                $medals = $userPokemon->itemGroupMedalGroup->medalGroup->medals;
                $userPokemon->modifiedStats = $this->calculateModifiedStats($baseStats, $items, $medals);
            }
        }

        // ビューにデータを渡す
        return view('posts.myteam', compact('teams'));
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
    
        // Check if the logged-in user owns the team
        if (auth()->id() !== $team->user_id) {
            return back()->with('error', 'Unauthorized to perform this action.');
        }
    
        // Delete associated UserPokemon records first to maintain database integrity
        UserPokemon::where('team_id', $team->id)->delete();
    
        // Now delete the team
        $team->delete();
    
        return redirect()->route('myteam.index')->with('success', 'Team deleted successfully.');
    }
    
    public function updateLevel(Request $request, $userPokemonId)
    {
        $level = $request->input('level');
        $pokemonName = $request->input('pokemon_name');  // フォームから送信されたポケモン名を取得
        $userPokemon = UserPokemon::with('itemGroupMedalGroup.itemGroup', 'itemGroupMedalGroup.medalGroup')->findOrFail($userPokemonId);
    
        // Fetch the Pokémon data directly from the pokemons table
        $pokemonData = PokeModel::where('pokemon_name', $pokemonName)->where('lv', $level)->first();
    
        if (!$pokemonData) {
            return back()->with('error', 'No pokemon data found for selected level.');
        }
    
        // Calculate modified stats based on the new level and associated items/medals
        $items = $userPokemon->itemGroupMedalGroup->itemGroup->items;
        $medals = $userPokemon->itemGroupMedalGroup->medalGroup->medals;
        $modifiedStats = $this->calculateModifiedStats([
            'hp' => $pokemonData->hp,
            'attack' => $pokemonData->attack,
            'defense' => $pokemonData->defense,
            'sp_attack' => $pokemonData->sp_attack,
            'sp_defense' => $pokemonData->sp_defense,
            'crit_rate' => $pokemonData->crit_rate,
            'life_steal' => $pokemonData->crit_rate,
            'cdr' => $pokemonData->cdr,
            'attack_speed' => $pokemonData->attack_speed,
            'move_speed' => $pokemonData->move_speed,
            'lv' => $pokemonData->lv,
        ], $items, $medals);
        
    $currentData = session('updatedPokemons', []);
    $currentData[$userPokemonId] = [
        'selectedPokemon' => $userPokemon,
        'pokemonData' => $pokemonData,
        'modifiedStats' => $modifiedStats
    ];
    session(['updatedPokemons' => $currentData]);

    return redirect()->route('myteam.index');
    }
    
    private function calculateModifiedStats($baseStats, $items, $medals) {
        $modifiedStats = $baseStats;  // ベースのステータスをコピー
    
        foreach ($items as $item) {
            // アイテムの効果を加算
            $modifiedStats['hp'] += $item->hp;
            $modifiedStats['attack'] += $item->attack;
            $modifiedStats['defense'] += $item->defense;
            $modifiedStats['sp_attack'] += $item->sp_attack;
            $modifiedStats['sp_defense'] += $item->sp_defense;
            $modifiedStats['crit_rate'] += $item->crit_rate;
            $modifiedStats['cdr'] += $item->cdr;
            $modifiedStats['attack_speed'] += $item->attack_speed;
            $modifiedStats['move_speed'] += $item->move_speed;
        }
    
        foreach ($medals as $medal) {            
            $modifiedStats['hp'] += $medal->hp;
            $modifiedStats['attack'] += $medal->attack;
            $modifiedStats['defense'] += $medal->defense;
            $modifiedStats['sp_attack'] += $medal->sp_attack;
            $modifiedStats['sp_defense'] += $medal->sp_defense;
            $modifiedStats['crit_rate'] += $medal->crit_rate;
            $modifiedStats['cdr'] += $medal->cdr;
            $modifiedStats['move_speed'] += $medal->move_speed;
        }
    
        return $modifiedStats;
    }
    
}
