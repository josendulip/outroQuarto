<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('house_code');
            $table->string('city');
            $table->string('county');
            $table->string('district');
            $table->string('street');
            $table->string('period');
            $table->string('type');
            $table->string('payment_METHOD');
            $table->string('price');
            $table->string('room');
            $table->string('living_room');
            $table->string('kitchen');
            $table->string('bathroom');
            $table->string('garden');
            $table->string('furniture');
            $table->string('state');
            $table->text('description');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('truth')->default(1);
            $table->boolean('untrue')->default(0);

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
        Schema::dropIfExists('announces');
    }
}
