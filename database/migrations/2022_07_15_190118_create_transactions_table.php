<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trans_id')->nullable();
            $table->string('reference')->nullable();
            $table->string('user_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('student_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('name')->nullable();
            $table->string('department_id')->nullable();
            $table->string('program')->nullable();
            $table->string('level')->nullable();
            $table->string('faculty_id')->nullable();
            $table->string('session')->nullable();
            $table->string('semester')->nullable();
            $table->string('status')->default('initiated');

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
        Schema::dropIfExists('transactions');
    }
}
