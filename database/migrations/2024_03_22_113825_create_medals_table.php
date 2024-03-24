<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medals', function (Blueprint $table) {
            $table->id();
            $table->string('medal_name');
            $table->string('medal_color_1');
            $table->string('medal_color_2')->nullable();
            $table->integer('hp')->nullable();
            $table->double('attack')->nullable();
            $table->double('defense')->nullable();
            $table->double('sp_attack')->nullable();
            $table->double('sp_defense')->nullable();
            $table->decimal('crit_rate')->nullable();
            $table->decimal('cdr')->nullable();
            $table->double('move_speed')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medals');
    }
}
