<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_items', function (Blueprint $table) {
            $table->bigInteger('order_item_id' , true, true)->nullable(false);
            $table->bigInteger('order_id', false, true)->nullable(false);
            $table->bigInteger('product_id', false, true)->nullable(false);
            $table->integer('quantity')->default('1')->nullable(false);
            $table->bigInteger('refund')->default('1');
            $table->integer('resend_amount')->default('0')->nullable(false);
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unique(['order_id', 'product_id']);
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->foreign('product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_items');
    }
}
