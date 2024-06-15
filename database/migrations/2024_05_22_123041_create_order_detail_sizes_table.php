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
        Schema::create('order_detail_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('customer')->nullable();
            $table->string('name_product');
            $table->integer('body');
            $table->integer('waist');
            $table->integer('pelvis');
            $table->integer('armhole');
            $table->integer('length_shoulder');
            $table->integer('arm_length');
            $table->integer('length_shirt');
            $table->integer('length_face');
            $table->longText('desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail_sizes');
    }
};
