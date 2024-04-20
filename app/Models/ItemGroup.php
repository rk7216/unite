<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_group_items');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
