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
        Schema::create('production_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('themes_id');
            $table->unsignedBigInteger('user_id');
            $table->string('total_item');
            $table->string('grand_total');
            $table->timestamps();
        });

        Schema::table('production_costs', function ($table) {
            $table->foreign('themes_id')->references('id')->on('production_themes');
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
        //
    }
};
