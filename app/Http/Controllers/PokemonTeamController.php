<?php

//PokemonTeamController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Item;
use App\Models\ItemGroup;
use App\Models\MedalGroup;
use App\Models\Team;
use App\Models\UserPokemon;
use App\Models\ItemGroupMedalGroup;

class PokemonTeamController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->id();  // 認証されたユーザーIDを取得
        $pokemons = PokeModel::where('lv' ,1)->get();
        $itemGroups = ItemGroup::where('user_id', $user_id)->get();
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
    
        return view('posts.team', compact('pokemons', 'itemGroups', 'medalGroups', 'pokemon_levels', 'selectedPokemon'));
    }
    
    public function store(Request $request)
    {
        $user = auth()->user(); // Ensure the user is authenticated
    
        // Create a new team
        $team = new Team;
        $team->team_name = $request->input('team_name'); // Modify as necessary or take from input
        $team->user_id = $user->id;
        $team->save();
    
        // Prepare arrays to hold detailed data to show after save
        $details = [];
    
        // Save each pokemon with its item and medal group
        $pokemons = $request->input('pokemons', []);
        $itemGroups = $request->input('item_groups', []);
        $medalGroups = $request->input('medal_groups', []);
    
        foreach ($pokemons as $index => $pokemonId) {
            if ($pokemonId && isset($itemGroups[$index]) && isset($medalGroups[$index])) {
                $userPokemon = new UserPokemon;
                $userPokemon->team_id = $team->id;
                $userPokemon->pokemon_id = $pokemonId;
    
                // Fetch full details of items and medals
                $itemGroup = ItemGroup::with('items')->find($itemGroups[$index]);
                $medalGroup = MedalGroup::with('medals')->find($medalGroups[$index]);
    
                // Check if both groups are loaded properly
                if (!$itemGroup || !$medalGroup) {
                    continue; // Skip this iteration if the necessary data is missing
                }
    
                // Attach the item group and medal group
                $itemGroupMedalGroup = ItemGroupMedalGroup::firstOrCreate([
                    'item_group_id' => $itemGroups[$index],
                    'medal_group_id' => $medalGroups[$index]
                ]);
    
                $userPokemon->item_group_medal_group_id = $itemGroupMedalGroup->id;
                $userPokemon->save();
    
                // Add details for display
                $details[] = [
                    'pokemon' => PokeModel::find($pokemonId),
                    'items' => $itemGroup->items,
                    'medals' => $medalGroup->medals
                ];
            }
        }
    
        // Redirect with the team details to be displayed
        return redirect()->route('team.index')->with([
            'success' => 'Team saved successfully!',
            'teamDetails' => $details,
            'teamName' => $team->team_name
        ]);
    }
}
