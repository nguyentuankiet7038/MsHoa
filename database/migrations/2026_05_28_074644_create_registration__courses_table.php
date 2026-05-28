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
        Schema::create('registration_courses', function (Blueprint $table) {
            $table->id('registrationid');
            $table->integer('studentid');
            $table->integer('classid');
            $table->date('registration_date');   
            $table->enum('status',['pending','approved','rejected','canceled'])->default('pending');
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
        Schema::dropIfExists('registration__courses');
    }
};
