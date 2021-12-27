<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->longText('description');
            $table->string('price1')->nullable(false);
            $table->string('price2')->nullable(false);
            $table->string('price3')->nullable(false);
            $table->string('price4')->nullable(false);
            $table->string('adults')->nullable(false);
            $table->string('children')->nullable(false);
            $table->string('image');
            $table->boolean('enabled')->default(true)->nullable(false);
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
        Schema::dropIfExists('room_categories');
    }
}
