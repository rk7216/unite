<?php

//PokemonTeamController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Item;
use App\Models\Medal;

class PokemonTeamController extends Controller
{
    public function index(Request $request)
    {
        $pokemons = PokeModel::all();
        $items = Item::all(); // アイテムの一覧を取得
        $medals = Medal::all(); // メダルの一覧を取得
        
        $selectedPokemonName = $request->query('pokemon_name');
        $selectedPokemon = null;
        $pokemon_levels = collect();
    
        if ($selectedPokemonName) {
            $selectedPokemon = PokeModel::where('pokemon_name', $selectedPokemonName)->first();
            if ($selectedPokemon) {
                $pokemon_levels = collect([$selectedPokemon]);
            }
        }
    
        return view('posts.team', compact('pokemons', 'items', 'medals', 'pokemon_levels', 'selectedPokemon'));
    }
}
