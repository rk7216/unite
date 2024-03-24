<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ItemData = [
            [
                'item_name' => 'Aeos Cookie',
                'hp' => 240,
            ],
            [
                'item_name' => 'Assault Vest',
                'hp' => 270,
                'defense' => 35,
                'sp_defense' => 51,
            ],
            [
                'item_name' => 'Attack Weight',
                'attack' => 18,
            ],
            [
                'item_name' => 'Buddy Barrier',  
                'hp' => 450,
            ],
            [
                'item_name' => 'Charging Charm',
                'attack' => 15,
                'move_speed' => 120,
            ],
            [
                'item_name' => 'Choice Specs',
                'sp_attack' => 39,
            ],
            [
                'item_name' => 'Curse Bangle',
                'attack' => 24,
            ],
            [
                'item_name' => 'Curse Incense',
                'sp_attack' => 39,
            ],
            [
                'item_name' => 'Drain Crown',
                'hp' => 120,
                'attack' => 18,
            ],
            [
                'item_name' => 'Energy Amplifier',
                'cdr' => 0.045,
            ],
            [
                'item_name' => 'Exp. Share',
                'hp' => 240,
                'move_speed' => 150,
            ],
            [
                'item_name' => 'Float Stone',
                'hp' => 24,
                'move_speed' => 150,
            ],
            [
                'item_name' => 'Focus Band',
                'defense' => 30,
                'sp_defense' => 30,
            ],
            [
                'item_name' => 'Leftovers',
                'hp' => 360,
            ],
            [
                'item_name' => 'Muscle Band',
                'attack' => 15,
                'attack_speed' => 1.075,
            ],
            [
                'item_name' => 'Rapid-Fire Scarf',
                'attack' => 12,
                'attack_speed' => 1.090,
            ],
            [
                'item_name' => 'Razor Claw',
                'attack' => 15,
                'crit_rate' => 0.021,
            ],
            [
                'item_name' => 'Rescue Hood',
                'defense' => 30,
                'sp_defense' => 30,
            ],
            [
                'item_name' => 'Resonant Guard',
                'hp' => 450,
            ],
            [
                'item_name' => 'Rocky Helmet',
                'hp' => 270,
                'defense' => 51,
            ],
            [
                'item_name' => 'Scope Lens',
                'crit_rate' => 0.06,
            ],
            [
                'item_name' => 'Score Shield',
                'hp' => 450,
            ],
            [
                'item_name' => 'Shell Bell',
                'sp_attack' => 24,
                'cdr' => 0.045,
            ],
            [
                'item_name' => 'Slick Spoon',
                'hp' => 210,
                'sp_attack' => 30,
            ],
            [
                'item_name' => 'Sp. Atk Specs',
                'sp_attack' => 24,
            ],
            [
                'item_name' => 'Weakness Policy',
                'hp' => 210,
                'attack' => 15,
            ],
            [
                'item_name' => 'Wise Glasses',
                'sp_attack' => 39,
            ],
        ];

        foreach ($ItemData as $data) {
            DB::table('items')->insert($data); // itemsテーブルにデータを挿入
        }
/*        Item::create([
            'item_name' => 'Aeos Cookie',
            'hp' => 240,
            'attack' => null,
            'defense' => null,
            'sp_attack' => null,
            'sp_defense' => null,
            'crit_rate' => null,
            'cdr' => null,
            'attack_speed' => null,
            'move_speed' => null,
            'image' => null,
        ]);
*/        
//
    }
}
