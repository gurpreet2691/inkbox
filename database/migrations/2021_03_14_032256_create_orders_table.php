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
            $table->id('order_id');
            $table->bigInteger('order_number', false, true);
            $table->bigInteger('customer_id', false, true)->nullable();
            $table->float('total_price')->default('0')->nullable(false);
            $table->string('fulfillment_status', 25)->nullable();
            $table->timestamp('fulfilled_date')->nullable();
            $table->enum('order_status', ['pending','active','done','cancelled','resend'])->nullable();
            $table->integer('customer_order_count')->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
