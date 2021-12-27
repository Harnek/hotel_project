<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id')->nullable(false);
            $table->unsignedBigInteger('category_id')->nullable(false);
            $table->unsignedBigInteger('customer_id')->nullable(false);
            $table->unsignedBigInteger('order_id')->nullable(false);
            $table->date('check_in')->nullable(false);
            $table->date('check_out')->nullable(false);
            $table->integer('guests')->nullable();
            $table->longText('notes')->nullable();
            $table->boolean('cancelled')->default(false)->nullable(false);
            $table->longText('cancel_msg')->nullable();
            $table->boolean('failed')->default(false)->nullable(false);
            $table->longText('fail_msg')->nullable();
            $table->timestamps();
            
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('category_id')->references('id')->on('room_categories');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archives');
    }
}
