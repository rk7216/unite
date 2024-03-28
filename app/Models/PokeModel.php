<?php

//PokeModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PokeModel extends Model
{
    protected $table = 'pokemons'; // テーブル名を指定する

    // 以下にポケモンに関連するメソッドやリレーションシップを定義する
    public function levels()
    {
        return $this->hasMany(PokemonLevel::class, 'pokemon_name', 'pokemon_name');
    }
}
