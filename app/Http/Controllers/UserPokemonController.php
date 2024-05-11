<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPokemon;

class UserPokemonController extends Controller
{
    public function store(Request $request)
    {
        $userPokemon = new UserPokemon();
        $userPokemon->team_id = $request->input('team_id');
        $userPokemon->pokemon_id = $request->input('pokemon_id');
        $userPokemon->item_group_medal_group_id = $request->input('item_group_medal_group_id');
        $userPokemon->save();

        return redirect()->route('teams.index')->with('success', 'Pokemon added to team successfully.');
    }
}
