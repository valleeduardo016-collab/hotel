<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('reservations', function (Blueprint $table) {
        $table->date('check_in')->after('room_id');
        $table->date('check_out')->after('check_in');
    });
}

public function down()
{
    Schema::table('reservations', function (Blueprint $table) {
        $table->dropColumn(['check_in', 'check_out']);
    });
}
};
