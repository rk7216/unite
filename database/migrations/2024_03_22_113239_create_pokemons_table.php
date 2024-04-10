<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();
            $table->string('pokemon_name');
            $table->integer('lv');
            $table->integer('hp');
            $table->double('attack');
            $table->double('defense');
            $table->double('sp_attack');
            $table->double('sp_defense');
            $table->decimal('crit_rate', 5, 4);
            $table->decimal('cdr', 5, 4);
            $table->double('life_steal');
            $table->double('attack_speed');
            $table->double('move_speed');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemons');
    }
}
