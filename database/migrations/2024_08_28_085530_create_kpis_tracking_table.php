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
        Schema::create('kpis_trackings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kpis_assignments_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id kpis assignments là khóa ngoại được quan hệ với bảng kpis assignments');
            $table->integer('tracking_value')->nullable()->default(NULL)->comment('Lưu giá trị theo dõi');
            $table->date('tracking_date')->nullable()->default(NULL)->comment('Lưu thời gian theo dõi');            
            // Tạo quan hệ với bảng users            
            $table->foreign('kpis_assignments_id')->references('id')->on('kpis_assignments')->onDelete('cascade');
            // Tạo quan hệ với bảng permissions
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpis_trackings');
    }
};
