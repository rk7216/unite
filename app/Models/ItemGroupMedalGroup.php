<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemGroupMedalGroup extends Model
{
    protected $table = 'item_groups_medal_groups';

    protected $fillable = ['item_group_id', 'medal_group_id'];
    
    // ItemGroupリレーション
    public function itemGroup()
    {
        return $this->belongsTo(ItemGroup::class, 'item_group_id');
    }

    // MedalGroupリレーション
    public function medalGroup()
    {
        return $this->belongsTo(MedalGroup::class, 'medal_group_id');
    }
}
