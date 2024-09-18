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
        Schema::create('block_adminssions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(FALSE)->default(NULL)->comment('Lưu tên của khối xét tuyển: Khối A, Khối B, ...');
            $table->string('code')->nullable(FALSE)->comment('Lưu tên của khối xét tuyển: Khối A, Khối B, ...');
            $table->string('subject')->nullable(FALSE)->comment('Lưu tổ hợp tên môn học: Toán, Lý, Hóa ....');            
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
        Schema::dropIfExists('block_adminssions');
    }
};
