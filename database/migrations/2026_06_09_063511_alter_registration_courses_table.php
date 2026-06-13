<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('registration_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('courseid')->after('studentid')->nullable();
        });
        
        DB::statement('ALTER TABLE registration_courses MODIFY classid INT NULL;');
    }

    public function down()
    {
        Schema::table('registration_courses', function (Blueprint $table) {
            $table->dropColumn('courseid');
        });
        
        DB::statement('ALTER TABLE registration_courses MODIFY classid INT NOT NULL;');
    }
};
