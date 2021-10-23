<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('surname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('gender');
            $table->string('dob');
            $table->string('houseAddress');
            $table->string('placeOfBirth');
            $table->string('religion');
            $table->string('nationality');
            $table->string('stateOfOrigin');
            $table->string('emergencyContact');
            $table->string('dateOfRegistration');
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
        Schema::dropIfExists('students');
    }
}
