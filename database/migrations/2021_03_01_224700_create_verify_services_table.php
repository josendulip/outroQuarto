<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifyServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('house_code');
            $table->string('username');
            $table->string('phone');
            $table->string('email');
            $table->string('house_city');
            $table->string('house_county');
            $table->string('house_district');
            $table->string('house_street');
            $table->string('price')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('hour')->nullable();
            $table->string('minute')->nullable();
            $table->string('receipt')->nullable();
            $table->string('request_type');
            $table->text('description')->nullable();
            $table->string('status')->default('pending');

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
        Schema::dropIfExists('verify_services');
    }
}
