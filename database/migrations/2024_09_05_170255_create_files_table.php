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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(FALSE)->comment('Lưu thông tin tiêu để mô tả ảnh, file gì: avatar, bằng tốt nghiệp');
            $table->bigInteger('leads_id')->unsigned()->nullable(TRUE)->default(NULL)->comment('Lưu id của thí sinh');
            $table->bigInteger('students_id')->unsigned()->nullable(TRUE)->default(NULL)->comment('Lưu id của sinh viên');
            $table->bigInteger('employees_id')->unsigned()->nullable(TRUE)->default(NULL)->comment('Lưu id của nhân viên');
            $table->string('image_url')->nullable(FALSE)->comment('Lưu đường dẫn file ảnh tải ảnh');            
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');
            // Quan hệ
            $table->foreign('leads_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('employees_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
