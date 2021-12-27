<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable(false);
            $table->string('room_number')->unique()->nullable();
            $table->string('floor')->nullable();
            $table->boolean('enabled')->default(true)->nullable(false);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('room_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
