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
        Schema::create('credit_payment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_pay_id');
            $table->string('month');
            $table->string('no_credit');
            $table->string('bill');
            $table->string('status');
            $table->string('pay_date');
            $table->timestamps();
        });

        Schema::table('credit_payment_details', function ($table) {
            $table->foreign('credit_pay_id')->references('id')->on('credit_payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_payment_details');
    }
};
