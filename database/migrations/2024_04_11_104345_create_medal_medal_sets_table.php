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
        Schema::create('medal_medal_set', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medal_id');
            $table->unsignedBigInteger('medal_set_id');
            $table->foreign('medal_id')->references('id')->on('medals')->onDelete('cascade');
            $table->foreign('medal_set_id')->references('id')->on('medal_sets')->onDelete('cascade');
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
        Schema::dropIfExists('medal_medal_sets');
    }
};
