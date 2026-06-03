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
        if (Schema::hasColumn('reservations', 'start_date')) {
            $table->dropColumn('start_date');
        }

        if (Schema::hasColumn('reservations', 'end_date')) {
            $table->dropColumn('end_date');
        }
    });
}

public function down()
{
    Schema::table('reservations', function (Blueprint $table) {
        $table->date('start_date');
        $table->date('end_date');
    });
}
};
