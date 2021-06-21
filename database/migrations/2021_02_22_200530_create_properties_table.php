<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('house_code');
            $table->string('status')->default('Active');
            $table->string('city');
            $table->string('county');
            $table->string('district')->nullable();
            $table->string('street')->nullable();
            $table->string('period')->default('long period');
            $table->string('type');
            $table->string('payment_METHOD');
            $table->string('price');
            $table->string('room');
            $table->string('living_room');
            $table->string('kitchen');
            $table->string('bathroom');
            $table->boolean('seal')->default(0);
            $table->boolean('furniture')->default(0);
            $table->boolean('state')->default(0);
            $table->boolean('verification')->default(0);
            $table->text('description');
            $table->string('profile')->default('images/property/thumbnail/no-image.png');
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('slug')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
