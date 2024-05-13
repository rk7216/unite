<?php

// MedalGroup.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedalGroup extends Model
{
    protected $table = 'medal_groups';
    
    protected $fillable = ['name', 'user_id']; // 代入可能な属性
    
    // メダルセットが属するユーザーを取得
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // メダルセットに含まれるメダルを取得
    public function medals()
    {
        return $this->belongsToMany(Medal::class, 'medal_group_medals', 'medal_group_id', 'medal_id')
                    ->withTimestamps();
    }
    
    public function getAllMedalImagesUrls()
    {
        return $this->medals->pluck('image')->filter()->toArray();
    }

    
    public function calculateTotalStats()
    {
        $stats = [
            'hp' => 0, 'attack' => 0, 'defense' => 0,
            'sp_attack' => 0, 'sp_defense' => 0, 'crit_rate' => 0,
            'cdr' => 0, 'move_speed' => 0
        ];
    
        foreach ($this->medals as $medal) {
            foreach ($stats as $key => $value) {
                $stats[$key] += $medal->{$key} ?? 0;
            }
        }
        return $stats;
    }
    
    public function countMedalColors()
    {
        $colorCounts = [];

        foreach ($this->medals as $medal) {
            // color_1 のカウント
            $color1 = $medal->medal_color_1;
            if ($color1) {
                if (!isset($colorCounts[$color1])) {
                    $colorCounts[$color1] = 0;
                }
                $colorCounts[$color1]++;
            }

            // color_2 のカウント
            $color2 = $medal->medal_color_2;
            if ($color2) {
                if (!isset($colorCounts[$color2])) {
                    $colorCounts[$color2] = 0;
                }
                $colorCounts[$color2]++;
            }
        }

        return $colorCounts;
        
    }
}
