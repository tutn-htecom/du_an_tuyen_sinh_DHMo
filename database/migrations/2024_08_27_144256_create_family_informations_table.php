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
        Schema::create('family_informations', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->nullable(TRUE)->default(NULL)->comment('Lưu kiểu thông tin: 0: cha, 1: mẹ, 2: vợ, 3: chồng, 4: con');
            $table->string('title', 255)->nullable(TRUE)->comment('Lưu mô tả thông tin người thân trong gia đình: Thông tin cha, Thông tin mẹ ...');                        
            $table->bigInteger('leads_id')->unsigned()->nullable()->comment('Lưu id của thí sinh quan hệ với bảng leads');
            $table->bigInteger('students_id')->unsigned()->nullable()->comment('Lưu id của thí sinh quan hệ với bảng students');            
            $table->string('full_name', 255)->nullable(false)->comment('Lưu họ và tên người thân');
            // $table->tinyInteger('gender')->nullable(TRUE)->default(NULL)->comment('Lưu giới tính của người thân trong gia đình');
            $table->integer('year_of_birth')->nullable(true)->comment('Lưu năm sinh người thân');
            $table->string('phone_number')->nullable(false)->comment('Lưu số điện thoại nhà riêng');            
            $table->string('jobs')->nullable()->comment('Lưu nghề nghiệp của người thân');     
            $table->bigInteger('education_id')->unsigned()->nullable()->comment('Lưu id của trình độ học vấn');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');
            
            //Quan hệ với bảng provinces
            $table->foreign('education_id')->references('id')->on('educations_types')->onDelete('cascade');            
            $table->foreign('leads_id')->references('id')->on('leads')->onDelete('cascade');            
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_informations');
    }
};
