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
        Schema::create('kpis_assignments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kpis_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id kpis');
            $table->bigInteger('users_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id người được phân công');
            $table->date('assignment_date')->nullable()->default(NULL)->comment('Lưu ngày được phân công thực hiện');
            // Tạo quan hệ với bảng users            
            $table->foreign('kpis_id')->references('id')->on('kpis')->onDelete('cascade');
            // Tạo quan hệ với bảng permissions
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpis_assignments');
    }
};
