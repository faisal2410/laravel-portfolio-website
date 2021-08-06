<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('courseName');
	        $table->string('courseDes');
            $table->string('courseFee');
            $table->string('courseTotalEnroll');
            $table->string('courseTotalClass');
            $table->string('courseLink');
            $table->string('courseImg');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
