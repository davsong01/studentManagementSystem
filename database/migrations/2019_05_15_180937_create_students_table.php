<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('locked')->default(0);
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('semester')->nullable();
            $table->string('level')->nullable();
            $table->string('phone')->nullable();
            $table->string('current_gpa')->nullable();
            $table->string('current_cgpa')->nullable();
            $table->string('lga')->nullable();
            $table->string('program')->nullable();
            $table->date('dateofbirth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('current_address')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('religion')->nullable();
            $table->string('year_of_admission')->nullable();
            $table->string('nok')->nullable();
            $table->string('nok_address')->nullable();
            $table->string('nok_name')->nullable();
            $table->string('nok_phone')->nullable();
            $table->string('nok_relationship')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
