<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medal_sets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // メダルセットの名前
            $table->integer('hp')->nullable();
            $table->double('attack')->nullable();
            $table->double('defense')->nullable();
            $table->double('sp_attack')->nullable();
            $table->double('sp_defense')->nullable();
            $table->decimal('crit_rate', 5, 4)->nullable();
            $table->decimal('cdr', 5, 4)->nullable();
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
        Schema::dropIfExists('medal_sets');
    }
};
