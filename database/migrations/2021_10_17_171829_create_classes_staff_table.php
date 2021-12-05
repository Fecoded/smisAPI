<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_staff', function (Blueprint $table) {
            $table->uuid('classId');
            $table->uuid('staffId');
            $table->foreign('classId')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('staffId')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes_staff');
    }
}
