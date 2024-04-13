<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medal extends Model
{
    protected $table = 'medals'; // テーブル名を指定する
    public function medalSets()
    {
        return $this->belongsToMany(MedalSet::class, 'medal_medal_set');
    }
}
