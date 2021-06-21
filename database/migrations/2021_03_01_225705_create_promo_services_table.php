<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_services', function (Blueprint $table) {
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
            $table->string('fixed_amount_per_day');
            $table->string('total_days');
            $table->string('total_amount');
            $table->string('receipt_promo');
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
        Schema::dropIfExists('promo_services');
    }
}
