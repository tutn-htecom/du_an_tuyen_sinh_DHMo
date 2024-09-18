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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->nullable(TRUE)->default(NULL)->comment('Lưu kiểu thông tin: 0: Địa chỉ liên lạc (DCLL), 1: Hộ khẩu thường trú (HKTT)');
            $table->string('title')->nullable(true)->comment('Lưu tiêu đề của địa chỉ: Vd Hộ khẩu thường trú, Địa chỉ liên lạc');            
            $table->bigInteger('leads_id')->unsigned()->nullable()->comment('Lưu địa chỉ thí sinh, sinh viên, giao viên');
            $table->bigInteger('students_id')->unsigned()->nullable()->comment('Lưu id của sinh viên');            
            // $table->bigInteger('provinces_id')->unsigned()->nullable()->comment('Lưu province id của Tỉnh Thành Phố tương ứng');
            // $table->bigInteger('districts_id')->unsigned()->nullable()->comment('Lưu province id của Quận / Huyện tương ứng');
            // $table->bigInteger('wards_id')->unsigned()->nullable()->comment('Lưu province id của Phường/ Xã');            
            $table->string('provinces_name', 255)->nullable()->comment('Lưu tên của Tỉnh Thành Phố tương ứng');
            $table->string('districts_name', 255)->nullable()->comment('Lưu tên của Quận / Huyện tương ứng');
            $table->string('wards_name', 255)->nullable()->comment('Lưu tên của Phường/ Xã');
            $table->string('address', 255)->nullable()->comment('Lưu địa chỉ thí sinh, sinh viên, giao viên');            
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');
            
            //Quan hệ với bảng provinces
            // $table->foreign('provinces_id')->references('id')->on('provinces')->onDelete('cascade');            
            // $table->foreign('districts_id')->references('id')->on('districts')->onDelete('cascade');
            // $table->foreign('wards_id')->references('id')->on('wards')->onDelete('cascade');
            $table->foreign('leads_id')->references('id')->on('leads')->onDelete('cascade');            
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
