<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {

            if (!Schema::hasColumn('hotels', 'nombre')) {
                $table->string('nombre')->after('id');
            }

            if (!Schema::hasColumn('hotels', 'direccion')) {
                $table->string('direccion')->nullable();
            }

            if (!Schema::hasColumn('hotels', 'telefono')) {
                $table->string('telefono')->nullable();
            }

            if (!Schema::hasColumn('hotels', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('hotels', 'admin_id')) {
                $table->foreignId('admin_id')->nullable()->constrained('users');
            }
        });
    }

    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn([
                'nombre',
                'direccion',
                'telefono',
                'email',
                'admin_id'
            ]);
        });
    }
};