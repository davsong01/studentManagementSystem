<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_forms', function (Blueprint $table) {
            $table->id();
            $table->string('program');
            $table->string('status')->nullable();
            $table->string('level');
            $table->string('session');
            $table->string('department_id');
            $table->string('faculty_id');
            $table->string('semester');
            $table->text('available_courses')->nullable();
            $table->string('maximum_units');
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
        Schema::dropIfExists('course_forms');
    }
}
