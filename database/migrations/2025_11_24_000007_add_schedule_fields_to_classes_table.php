<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->unsignedSmallInteger('max')->nullable()->after('name');
            $table->string('day', 16)->nullable()->after('location');
            $table->time('time_1')->nullable()->after('day');
            $table->time('time_2')->nullable()->after('time_1');
        });
    }

    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn(['max', 'day', 'time_1', 'time_2']);
        });
    }
};

