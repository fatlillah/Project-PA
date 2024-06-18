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
        Schema::create('cash_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_order_id');
            $table->integer('discount');
            $table->bigInteger('accepted');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('cash_payments', function ($table) {
            $table->foreign('cash_order_id')->references('id')->on('completed_orders')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_payments');
    }
};
