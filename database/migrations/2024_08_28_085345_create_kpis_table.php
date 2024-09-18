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
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();            
            $table->string('kpis_name')->nullable(false)->comment('Lưu tên của kpis');                        
            $table->text('kpis_description')->nullable(false)->comment('Lưu mô tả của kpis');                        
            $table->integer('target_value')->nullable(false)->comment('Lưu mục tiêu của kpi (số ngày)');
            $table->date('target_deadline')->nullable()->default(NULL)->comment('Lưu ngày hoàn thành mục tiêu');                        
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpis');
    }
};
