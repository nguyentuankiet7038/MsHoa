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
        Schema::create('students', function (Blueprint $table) {
            $table->id('studentid');
            $table->string('studentname');
$table->unsignedBigInteger('userid');
            $table->date('dateofbirth');
            $table->string('gender');
            $table->string('address');
            $table->string('parentname');
            $table->string('parentphone');
            $table->timestamps();
            $table->foreign('userid') ->references('userid') ->on('users') ->onDelete('cascade');
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
};
