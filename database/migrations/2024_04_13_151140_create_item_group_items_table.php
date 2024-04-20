<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemGroupItemsTable extends Migration
{
    public function up()
    {
        Schema::create('item_group_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_group_id')->constrained('item_groups')->onDelete('cascade');
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_group_items');
    }
}
