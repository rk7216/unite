<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PokeModel;
use App\Models\Item;

class ImageSeeder extends Seeder
{
    public function run()
    {
        $pokemons = [
            'Absol', 'Aegislash', 'Azumarill', 'Blastoise', 'Blaziken', 'Blissey', 'Buzzwole', 'Chandelure', 
            'Charizard', 'Cinderace', 'Clefable', 'Comfey', 'Cramorant', 'Crustle', 'Decidueye', 'Delphox', 
            'Dodrio', 'Dragapult', 'Dragonite', 'Duraludon', 'Eldegoss', 'Espeon', 'Garchomp', 'Gardevoir', 
            'Gengar', 'Glaceon', 'Goodra', 'Greedent', 'Greninja', 'Gyarados', 'Hoopa', 'Inteleon', 'Lapras', 
            'Leafeon', 'Lucario', 'Machamp', 'Mamoswine', 'Meowscarada', 'Metagross', 'Mew', 'Mewtwo X', 'Mewtwo Y', 
            'Mimikyu', 'Miraidon', 'Mr. Mime', 'Ninetales', 'Pikachu', 'Sableye', 'Scizor', 'Scyther', 'Slowbro', 
            'Snorlax', 'Sylveon', 'Talonflame', 'Trevenant', 'Tsareena', 'Tyranitar', 'Umbreon', 'Urshifu', 'Venusaur', 
            'Wigglytuff', 'Zacian', 'Zeraora', 'Zoroark'
        ];

        $items = [
            'Aeos Cookie', 'Assault Vest', 'Attack Weight', 'Buddy Barrier', 'Charging Charm', 'Choice Specs', 
            'Curse Bangle', 'Curse Incense', 'Drain Crown', 'Energy Amplifier', 'Exp. Share', 'Float Stone', 
            'Focus Band', 'Leftovers', 'Muscle Band', 'Rapid-Fire Scarf', 'Razor Claw', 'Rescue Hood', 
            'Resonant Guard', 'Rocky Helmet', 'Scope Lens', 'Score Shield', 'Shell Bell', 'Slick Spoon', 
            'Sp. Atk Specs', 'Weakness Policy', 'Wise Glasses'
        ];

        // 画像のURLデータ
        $images = [
            ['name' => 'Absol', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354772/your_folder/Absol.png'],
            ['name' => 'Aegislash', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354750/your_folder/Aegislash.png'],
            ['name' => 'Azumarill', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354742/your_folder/Azumarill.png'],
            ['name' => 'Blastoise', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354757/your_folder/Blastoise.png'],
            ['name' => 'Blaziken', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354733/your_folder/Blaziken.png'],
            ['name' => 'Blissey', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354786/your_folder/Blissey.png'],
            ['name' => 'Buzzwole', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354773/your_folder/Buzzwole.png'],
            ['name' => 'Chandelure', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354736/your_folder/Chandelure.png'],
            ['name' => 'Charizard', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354729/your_folder/Charizard.png'],
            ['name' => 'Cinderace', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354775/your_folder/Cinderace.png'],
            ['name' => 'Clefable', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354786/your_folder/Clefable.png'],
            ['name' => 'Comfey', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354728/your_folder/Comfey.png'],
            ['name' => 'Cramorant', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354788/your_folder/Cramorant.png'],
            ['name' => 'Crustle', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354771/your_folder/Crustle.png'],
            ['name' => 'Decidueye', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354774/your_folder/Decidueye.png'],
            ['name' => 'Delphox', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354762/your_folder/Delphox.png'],
            ['name' => 'Dodrio', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354741/your_folder/Dodrio.png'],
            ['name' => 'Dragapult', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354780/your_folder/Dragapult.png'],
            ['name' => 'Dragonite', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354762/your_folder/Dragonite.png'],
            ['name' => 'Duraludon', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354730/your_folder/Duraludon.png'],
            ['name' => 'Eldegoss', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354781/your_folder/Eldegoss.png'],
            ['name' => 'Espeon', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354764/your_folder/Espeon.png'],
            ['name' => 'Garchomp', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354759/your_folder/Garchomp.png'],
            ['name' => 'Gardevoir', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354751/your_folder/Gardevoir.png'],
            ['name' => 'Gengar', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354736/your_folder/Gengar.png'],
            ['name' => 'Glaceon', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354772/your_folder/Glaceon.png'],
            ['name' => 'Goodra', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354784/your_folder/Goodra.png'],
            ['name' => 'Greedent', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354760/your_folder/Greedent.png'],
            ['name' => 'Greninja', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354771/your_folder/Greninja.png'],
            ['name' => 'Gyarados', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354747/your_folder/Gyarados.png'],
            ['name' => 'Hoopa', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354787/your_folder/Hoopa.png'],
            ['name' => 'Inteleon', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354752/your_folder/Inteleon.png'],
            ['name' => 'Lapras', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354746/your_folder/Lapras.png'],
            ['name' => 'Leafeon', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354779/your_folder/Leafeon.png'],
            ['name' => 'Lucario', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354738/your_folder/Lucario.png'],
            ['name' => 'Machamp', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354739/your_folder/Machamp.png'],
            ['name' => 'Mamoswine', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354787/your_folder/Mamoswine.png'],
            ['name' => 'Meowscarada', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354756/your_folder/Meowscarada.png'],
            ['name' => 'Metagross', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354766/your_folder/Metagross.png'],
            ['name' => 'Mew', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354790/your_folder/Mew.png'],
            ['name' => 'Mewtwo X', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354731/your_folder/MewtwoX.png'],
            ['name' => 'Mewtwo Y', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354731/your_folder/MewtwoY.png'],
            ['name' => 'Mimikyu', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354748/your_folder/Mimikyu.png'],
            ['name' => 'Miraidon', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354768/your_folder/Miraidon.png'],
            ['name' => 'Mr. Mime', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354759/your_folder/Mr.Mime.png'],
            ['name' => 'Ninetales', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354782/your_folder/Ninetales.png'],
            ['name' => 'Pikachu', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354740/your_folder/Pikachu.png'],
            ['name' => 'Sableye', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354743/your_folder/Sableye.png'],
            ['name' => 'Scizor', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354768/your_folder/Scizor.png'],
            ['name' => 'Scyther', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354753/your_folder/Scyther.png'],
            ['name' => 'Slowbro', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354769/your_folder/Slowbro.png'],
            ['name' => 'Snorlax', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354758/your_folder/Snorlax.png'],
            ['name' => 'Sylveon', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354764/your_folder/Sylveon.png'],
            ['name' => 'Talonflame', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354748/your_folder/Talonflame.png'],
            ['name' => 'Trevenant', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354741/your_folder/Trevenant.png'],
            ['name' => 'Tsareena', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354734/your_folder/Tsareena.png'],
            ['name' => 'Tyranitar', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354761/your_folder/Tyranitar.png'],
            ['name' => 'Umbreon', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354754/your_folder/Umbreon.png'],
            ['name' => 'Urshifu', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354732/your_folder/Urshifu.png'],
            ['name' => 'Venusaur', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354735/your_folder/Venusaur.png'],
            ['name' => 'Wigglytuff', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354737/your_folder/Wigglytuff.png'],
            ['name' => 'Zacian', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354777/your_folder/Zacian.png'],
            ['name' => 'Zeraora', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354784/your_folder/Zeraora.png'],
            ['name' => 'Zoroark', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354778/your_folder/Zoroark.png'],
            ['name' => 'Drain Crown', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354729/your_folder/Drain%2BCrown.png'],
            ['name' => 'Buddy Barrier', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354730/your_folder/Buddy%2BBarrier.png'],
            ['name' => 'Attack Weight', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354734/your_folder/Attack%2BWeight.png'],
            ['name' => 'Slick Spoon', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354738/your_folder/Slick%2BSpoon.png'],
            ['name' => 'Curse Bangle', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354739/your_folder/Curse%2BBangle.png'],
            ['name' => 'Aeos Cookie', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354743/your_folder/Aeos%2BCookie.png'],
            ['name' => 'Muscle Band', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354744/your_folder/Muscle%2BBand.png'],
            ['name' => 'Choice Specs', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354745/your_folder/Choice%2BSpecs.png'],
            ['name' => 'Charging Charm', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354749/your_folder/Charging%2BCharm.png'],
            ['name' => 'Assault Vest', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354750/your_folder/Assault%2BVest.png'],
            ['name' => 'Resonant Guard', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354751/your_folder/Resonant%2BGuard.png'],
            ['name' => 'Energy Amplifier', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354752/your_folder/Energy%2BAmplifier.png'],
            ['name' => 'Shell Bell', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354754/your_folder/Shell%2BBell.png'],
            ['name' => 'Rapid-Fire Scarf', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354755/your_folder/Rapid%2BFire%2BScarf.png'],
            ['name' => 'Rescue Hood', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354758/your_folder/Rescue%2BHood.png'],
            ['name' => 'Rocky Helmet', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354770/your_folder/Rocky%2BHelmet.png'],
            ['name' => 'Scope Lens', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354788/your_folder/Scope%2BLens.png'],
            ['name' => 'Score Shield', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354778/your_folder/Score%2BShield.png'],
            ['name' => 'Float Stone', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354780/your_folder/Float%2BStone.png'],
            ['name' => 'Leftovers', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354781/your_folder/Leftovers.png'],
            ['name' => 'Exp Share', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354765/your_folder/Exp%2BShare.png'],
            ['name' => 'Wise Glasses', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354766/your_folder/Wise%2BGlasses.png'],
            ['name' => 'Razor Claw', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354783/your_folder/Razor%2BClaw.png'],
            ['name' => 'Weakness Policy', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354761/your_folder/Weakness%2BPolicy.png'],
            ['name' => 'Sp. Atk Specs', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354776/your_folder/Sp.%2BAtk%2BSpecs.png'],
            ['name' => 'Curse Incense', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354774/your_folder/Curse%2BIncense.png'],
            ['name' => 'Exp. Share', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354765/your_folder/Exp%2BShare.png'],
            ['name' => 'Focus Band', 'url' => 'https://res.cloudinary.com/dqwauewqp/image/upload/v1713354763/your_folder/Focus%2BBand.png']
        ];

        // ポケモンの画像挿入
            foreach ($images as $image) {
                $pokemon = $image['name'];
                for ($level = 1; $level <= 15; $level++) {
                    PokeModel::where('pokemon_name', $pokemon)->where('lv', $level)
                        ->update(['image' => $image['url']]);
            }
        }

        // アイテムの画像挿入
        foreach ($images as $image) {
            $item = $image['name'];
            Item::where('item_name', $item)->update(['image' => $image['url']]);
        }
    }
}
