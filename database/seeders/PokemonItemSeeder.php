<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PokemonItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pokemons')->delete();

        // ポケモンIDとアイテムIDの組み合わせを配列に定義
        $pokemonItems = [
            ['pokemon_id' => 1, 'item_id' => 3, 'user_id' => 1],
            ['pokemon_id' => 1, 'item_id' => 17, 'user_id' => 1],
            ['pokemon_id' => 1, 'item_id' => 21, 'user_id' => 1],
            // 他のポケモンとアイテムの組み合わせ...
        ];

        // 各組み合わせを pokemon_item テーブルに挿入
        foreach ($pokemonItems as $pokemonItem) {
            DB::table('pokemon_item')->insert($pokemonItem);
        }
    }
}