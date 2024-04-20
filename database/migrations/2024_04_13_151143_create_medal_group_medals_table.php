<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedalGroupMedalsTable extends Migration
{
    public function up()
    {
        Schema::create('medal_group_medals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medal_group_id')->constrained('medal_groups')->onDelete('cascade');
            $table->foreignId('medal_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('medal_group_medals');
    }
};
