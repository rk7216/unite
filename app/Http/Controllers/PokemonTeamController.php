<?php

//PokemonTeamController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Item;
use App\Models\MedalGroup;

class PokemonTeamController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->id();  // 認証されたユーザーIDを取得
        $pokemons = PokeModel::where('lv' ,1)->get();
        $items = Item::all(); // アイテムの一覧を取得
        $medalGroups = MedalGroup::with('medals')->where('user_id', $user_id)->get(); // ユーザーに属するメダルグループとそのメダルを取得
        
        $selectedPokemonName = $request->query('pokemon_name');
        $selectedPokemon = null;
        $pokemon_levels = collect();
    
        if ($selectedPokemonName) {
            $selectedPokemon = PokeModel::where('pokemon_name', $selectedPokemonName)->first();
            if ($selectedPokemon) {
                $pokemon_levels = collect([$selectedPokemon]);
            }
        }
    
        return view('posts.team', compact('pokemons', 'items', 'medalGroups', 'pokemon_levels', 'selectedPokemon'));
    }
}
