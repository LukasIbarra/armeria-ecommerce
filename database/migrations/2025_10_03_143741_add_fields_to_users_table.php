<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users','role')) {
                $table->string('role')->default('customer')->after('password'); // admin | customer
            }
            if (!Schema::hasColumn('users','phone')) {
                $table->string('phone')->nullable()->after('role');
            }
            if (!Schema::hasColumn('users','rut')) {
                $table->string('rut')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users','license_file')) {
                $table->string('license_file')->nullable()->after('rut');
            }
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users','license_file')) {
                $table->dropColumn('license_file');
            }
            if (Schema::hasColumn('users','rut')) {
                $table->dropColumn('rut');
            }
            if (Schema::hasColumn('users','phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('users','role')) {
                $table->dropColumn('role');
            }
        });
    }
};
