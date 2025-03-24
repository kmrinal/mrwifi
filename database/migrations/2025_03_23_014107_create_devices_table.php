<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model')->nullable();
            $table->string('serial_number')->unique();
            $table->string('mac_address')->unique();
            $table->string('firmware_version')->nullable();
            $table->dateTime('last_seen')->nullable();
            $table->integer('configuration_version')->nullable();
            $table->string('device_key')->nullable(false);
            $table->string('device_secret')->nullable(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('devices');
    }
};