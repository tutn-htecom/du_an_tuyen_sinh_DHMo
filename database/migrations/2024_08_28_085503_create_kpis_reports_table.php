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
        Schema::create('kpis_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kpis_assignments_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id kpis assignments là khóa ngoại được quan hệ với bảng kpis assignments');
            $table->date('report_date')->nullable()->default(NULL)->comment('Lưu ngày được phân công thực hiện');
            $table->integer('completion_rate')->nullable()->default(NULL)->comment('Lưu tỷ lệ hoàn thành');                                  
            $table->foreign('kpis_assignments_id')->references('id')->on('kpis_assignments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpis_reports');
    }
};
