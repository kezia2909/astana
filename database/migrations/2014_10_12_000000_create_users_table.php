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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->string('user_type');
            $table->string('user_position');
            $table->string('id_group');
            $table->string('username')->unique();
            $table->string('image')->nullable();
            $table->string('password')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('ktp')->unique();
            $table->string('email')->unique();
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('city_id');
            

            $table->string('address');
            $table->string('postcode');
            $table->rememberToken();
            $table->integer('id_input');
            $table->string('cluster')->nullable();
            $table->string('tokopedia')->nullable();
            $table->string('shopee')->nullable();
            $table->string('lazada')->nullable();
            $table->string('bukalapak')->nullable();
            $table->string('blibli')->nullable();
            $table->timestamps();

            // $table->foreign('province_id')->references('id')->on('provinces');
            // $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
