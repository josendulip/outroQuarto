<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('property_id');
            $table->text('id_transation')->nullable();
            $table->string('username');
            $table->string('identity');
            $table->string('phone');
            $table->string('email');
            $table->string('user_address');
            $table->string('user_city');
            $table->string('user_country');
            $table->string('user_photo');
            $table->string('iban');
            $table->string('slug');
            $table->string('house_code');
            $table->string('house_city');
            $table->string('house_county');
            $table->string('house_district');
            $table->string('house_street');
            $table->string('paid_user_id');
            $table->string('paid_user_name');
            $table->string('paid_user_email');
            $table->string('paid_user_phone');
            $table->string('paid_user_address');
            $table->string('paid_amount');
            $table->string('paid_receipt');
            $table->string('paid_date');
            $table->string('percentage')->nullable();
            $table->string('outroQuarto_amount')->nullable();
            $table->string('trans_method');
            $table->string('receipt')->nullable();
            $table->string('service')->default('scheduled');
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->string('manager');
            $table->string('manager_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
