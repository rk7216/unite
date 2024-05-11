<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // If you are using Laravel 8 or later, you might want to include factory support for easier testing and seeding.

class PokeModel extends Model
{
    use HasFactory; // Only if using Laravel 8 or later

    protected $table = 'pokemons'; // Explicitly setting the table name is good practice.
    
    protected $fillable = ['pokemon_name', 'type', 'description', 'lv', 'hp', 'attack', 'defense', 'sp_attack', 'sp_defense', 'crit_rate', 'cdr', 'life_steal', 'attack_speed', 'move_speed', 'image']; // Add other attributes as needed.

    /**
     * Items associated with the Pokémon through a pivot table.
     */
    public function items()
    {
        return $this->belongsToMany(Item::class, 'pokemon_item', 'pokemon_id', 'item_id')
                    ->withTimestamps(); // Use timestamps if your pivot table includes created_at and updated_at columns.
    }

    /**
     * Medals associated with the Pokémon through a pivot table.
     */
    public function medals()
    {
        return $this->belongsToMany(MedalGroup::class, 'pokemon_medal', 'pokemon_id', 'medal_id')
                    ->withTimestamps(); // Use timestamps if your pivot table includes created_at and updated_at columns.
    }

    /**
     * Levels of the Pokémon, assuming a separate model for levels.
    */ 
    public function levels()
    {
        return $this->hasMany(Level::class, 'pokemon_id', 'id')->orderBy('level'); // Assuming 'Level' is a separate model and 'level' is a field in that model.
    }
    
    // ポケモンの特定のレベルデータを取得
    public function getLevelData($level)
    {
        return PokeModel::where('pokemon_name', $this->pokemon_name)
                        ->where('lv', $level)
                        ->first();
    }
}

/**
 * You might need to create a Level model if not already existing.
 */
class Level extends Model
{
    protected $fillable = ['pokemon_id', 'level', 'hp', 'attack', 'defense', 'sp_attack', 'sp_defense', 'speed']; // Customize as per your database schema.

    public function pokemon()
    {
        return $this->belongsTo(PokeModel::class, 'pokemon_id', 'id');
    }
}

