<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffNextOfKinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_next_of_kin', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('surname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('gender');
            $table->string('email');
            $table->string('phoneNumber1');
            $table->string('phoneNumber2');
            $table->string('address');
            $table->string('relationship');
            $table->string('staffId');
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
        Schema::dropIfExists('staff_next_of_kin');
    }
}
