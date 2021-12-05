<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sessionId');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('occupation');
            $table->string('email');
            $table->string('phoneNumber1');
            $table->string('phoneNumber2')->nullable();
            $table->string('houseAddress');
            $table->string('workAddress');
            $table->string('schoolName');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parents');
    }
}
