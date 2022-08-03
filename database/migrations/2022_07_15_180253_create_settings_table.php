<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('official_email')->nullable();
            $table->string('official_phone')->nullable();
            $table->string('current_session')->nullable();
            $table->string('smtp_email')->nullable();
            $table->string('smtp_host')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('mail_from_address')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->string('PAYSTACK_PUBLIC_KEY')->nullable();
            $table->string('PAYSTACK_SECRET_KEY')->nullable();
            $table->string('PAYSTACK_PAYMENT_URL')->nullable();
            $table->string('MERCHANT_EMAIL')->nullable();
            $table->string('logo')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
