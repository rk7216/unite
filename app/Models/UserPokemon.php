<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPokemon extends Model
{
    // テーブル名、もし標準の命名規則に従っていない場合は指定する
    protected $table = 'user_pokemons';

    // マスアサインメントで代入を許可するカラム
    protected $fillable = ['team_id', 'pokemon_id', 'item_group_medal_group_id'];

    // Teamリレーション
    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }
    
    public function pokemon()
    {
        return $this->belongsTo(PokeModel::class, 'pokemon_id', 'id');
    }
    
    public function itemGroupMedalGroup()
    {
        return $this->belongsTo(ItemGroupMedalGroup::class, 'item_group_medal_group_id');
    }

    // その他のリレーション（ポケモン、アイテム、メダルなど）
}