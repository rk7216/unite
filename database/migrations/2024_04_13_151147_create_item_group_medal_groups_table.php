<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemGroupMedalGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('item_groups_medal_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_group_id')->constrained('item_groups')->onDelete('cascade');
            $table->foreignId('medal_group_id')->constrained('medal_groups')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_groups_medal_groups');
    }
}
