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
        Schema::table('guest_network_users', function (Blueprint $table) {
            if (!Schema::hasColumn('guest_network_users', 'email')) {
                $table->string('email')->nullable();
            }
            if (!Schema::hasColumn('guest_network_users', 'phone')) {
                $table->string('phone')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_network_users', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone']);
        });
    }
}; 