<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_services', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->string('house_code');
            $table->string('username');
            $table->string('phone');
            $table->string('email');
            $table->string("address")->nullable();
            $table->string('house_city')->nullable();
            $table->string('house_county')->nullable();
            $table->string('house_district')->nullable();
            $table->string('house_street')->nullable();
            $table->string('price')->nullable();
            $table->string('date');
            $table->string('time');
            $table->string('receipt');
            $table->string('request_type');
            $table->string('owner')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('Not approved');

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
        Schema::dropIfExists('schedule_services');
    }
}
