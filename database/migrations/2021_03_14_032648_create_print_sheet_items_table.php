<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintSheetItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_sheet_items', function (Blueprint $table) {
            $table->id('psi_id');
            $table->bigInteger('ps_id', false, true)->nullable();
            $table->bigInteger('order_item_id', false, true)->nullable();
            $table->enum('status', ['pass','reject','complete'])->default('pass')->nullable(false);
            $table->string('image_url', 255)->nullable(false);
            $table->string('size', 255)->nullable(false);
            $table->integer('x_pos')->nullable(false);
            $table->integer('y_pos')->nullable(false);
            $table->integer('width')->nullable(false);
            $table->integer('height')->nullable(false);
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('ps_id')->references('ps_id')->on('print_sheet');
            $table->foreign('order_item_id')->references('order_item_id')->on('orders_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_sheet_items');
    }
}
