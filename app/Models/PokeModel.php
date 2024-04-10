<?php

//PokeModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PokeModel extends Model
{
    protected $table = 'pokemons'; // テーブル名を指定する
    
    public function items()
    {
        return $this->belongsToMany(Item::class, 'pokemon_item', 'pokemon_id', 'item_id')
                    ->withTimestamps(); // 中間テーブルにtimestamps()がある場合
    }

    public function medals()
    {
        return $this->belongsToMany(Medal::class, 'pokemon_medal', 'pokemon_id', 'medal_id')
                    ->withTimestamps(); // 中間テーブルにtimestamps()がある場合
    }

    public function levels()
    {
        return $this->hasMany(PokeModel::class, 'pokemon_name', 'pokemon_name')->orderBy('lv');
    }
}
