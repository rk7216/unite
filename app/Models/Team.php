<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    // テーブル名、もし標準の命名規則に従っていない場合は指定する
    protected $table = 'teams';

    // マスアサインメントで代入を許可するカラム
    protected $fillable = ['team_name', 'user_id'];

    // ユーザーリレーション
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // UserPokemonsリレーション
    public function userPokemons()
    {
        return $this->hasMany('App\Models\UserPokemon');
    }
}