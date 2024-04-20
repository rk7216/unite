<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('item_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // アイテムグループの名前
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーIDとの関連付け
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_groups');
    }
}
