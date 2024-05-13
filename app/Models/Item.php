<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items'; // テーブル名を指定する
    
    public function itemGroups()
    {
        return $this->belongsToMany(ItemGroup::class, 'item_group_items');
    }

}
