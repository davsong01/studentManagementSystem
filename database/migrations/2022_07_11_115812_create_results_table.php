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
            $table->string('accademic_session');
            $table->string('semester');
            $table->string('level'); // 100, 200
            $table->string('program'); // BSC, MSC, PHD
            $table->string('cgpa')->nuallable(); // BSC, MSC, PHD
            $table->string('gpa')->nulable(); // BSC, MSC, PHD
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
