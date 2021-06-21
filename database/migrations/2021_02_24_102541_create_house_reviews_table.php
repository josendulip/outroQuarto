<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_reviews', function (Blueprint $table) {
            $table->id();$table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('house_id');
            
            $table->string('house_code');
            $table->string('user_name')->nullable();
            $table->string('description')->nullable();
            $table->double('rating')->nullable();
            $table->tinyInteger('approved')->nullable();
            $table->string('mode')->default("true");

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('house_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_reviews');
    }
}
