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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_order_id');
            $table->unsignedBigInteger('tenor_id');
            $table->timestamps();
        });

        Schema::table('credits', function ($table) {
            $table->foreign('credit_order_id')->references('id')->on('completed_orders')->onDelete('cascade');
            $table->foreign('tenor_id')->references('id')->on('tenors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credits');
    }
};
