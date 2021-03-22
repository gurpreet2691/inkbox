<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('title', 100)->default('')->nullable(false);
            $table->string('vendor', 50)->nullable();
            $table->string('type', 25)->nullable();
            $table->string('size', 20)->nullable();
            $table->float('price')->default(0);
            $table->string('handle', 75)->nullable();
            $table->integer('inventory_quantity')->default(0)->nullable(false);
            $table->string('sku', 30)->nullable();
            $table->string('design_url', 255)->nullable();
            $table->enum('published_state', ['inactive','active'])->default('active')->nullable(false);
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
        Schema::drop('products');
    }
}
