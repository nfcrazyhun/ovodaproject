<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('student_id');
            $table->string('street_name');
            $table->string('street_number');
            $table->unsignedInteger('zip');
            $table->string('city');
            $table->unsignedInteger('siblings_num');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('student')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
