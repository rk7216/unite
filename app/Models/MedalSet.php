<?php

// MedalSet.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedalSet extends Model
{
    protected $table = 'medal_sets';
    
    // メダルセットが属するユーザーを取得
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // メダルセットに含まれるメダルを取得
    public function medals()
    {
        return $this->belongsToMany(Medal::class, 'medal_medal_set', 'medal_set_medals', 'medal_set_id', 'medal_id')
                    ->withTimestamps();
    }
}
