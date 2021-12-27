<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id')->unique()->nullable(false);
            $table->enum('order_status', ['pending', 'processed', 'cancelled', 'failed'])->default('pending')->nullable(false);
            $table->date('order_created')->nullable(false);
            $table->enum('payment_method', ['paytm', 'cash', 'other'])->default('paytm')->nullable(false);
            $table->enum('payment_status', ['pending', 'paid', 'refunded', 'failed'])->default('pending')->nullable(false);
            $table->string('currency')->default('INR')->nullable();
            $table->string('total')->nullable(false);
            $table->string('txn_id')->nullable();
            $table->longText('resp_msg')->nullable();
            $table->longText('cancel_msg')->nullable();
            $table->longText('fail_msg')->nullable();
            
            $table->json('category_id')->nullable(false);
            $table->date('check_in')->nullable(false);
            $table->date('check_out')->nullable(false);
            $table->integer('rooms')->nullable(false);
            $table->integer('guests')->nullable(false);
            $table->longText('notes')->nullable();

            $table->string('price')->nullable(false);
            $table->string('discount')->nullable(false);
            $table->string('tax_percentage')->nullable(false);
            $table->string('tax')->nullable(false);
            $table->string('amount')->nullable(false);

            $table->unsignedBigInteger('customer_id')->nullable();            
            $table->timestamps();
            
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
