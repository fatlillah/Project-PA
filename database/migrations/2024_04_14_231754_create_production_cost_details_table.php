<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_cost_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('production_id');
            $table->unsignedBigInteger('product_id');
            $table->string('stock')->nullable();
            $table->string('net_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('subtotal');
            $table->timestamps();
        });

        Schema::table('production_cost_details', function ($table) {
            $table->foreign('production_id')->references('id')->on('production_costs');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('production_cost_details');
    }
};
