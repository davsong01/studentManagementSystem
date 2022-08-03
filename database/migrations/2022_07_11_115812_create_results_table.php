<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->nullable();
            $table->text('courses')->nullable();
            $table->string('academic_session')->nullable();
            $table->string('semester')->nullable();
            $table->string('department_id')->nullable();
            $table->string('faculty_id')->nullable();
            $table->string('level')->nullable();
            $table->string('program')->nullable();
            $table->string('cgpa')->nullable();
            $table->string('total_score')->nullable();
            $table->string('total_units')->nullable();
            $table->string('maximum_units')->nullable();
            $table->string('gpa')->nullable();
            $table->string('user_id')->nullable();
            
            $table->string('status')->nullable();
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
        Schema::dropIfExists('results');
    }
}
