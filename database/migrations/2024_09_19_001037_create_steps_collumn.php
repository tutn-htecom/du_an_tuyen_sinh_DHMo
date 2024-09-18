<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('leads')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->tinyInteger('steps')->nullable()->default(NULL)->comment('Lưu các bước thực đăng ký của Thí sinh');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('leads')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->tinyInteger('steps')->nullable()->default(NULL)->comment('Lưu các bước thực đăng ký của Thí sinh');
            });
        }
    }
};
