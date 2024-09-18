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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('types')->nullable(true)->default(0)->comment('Lưu kiểu user: 0: leads, 1.student, 2: nhân viên');            
            $table->string('email')->unique()->nullable(FALSE)->comment('Lưu email của người quản trị và sử dụng để đăng nhập hệ thống, không được phép trùng');            
            $table->smallInteger('status')->nullable(TRUE)->default(0)->comment('Lưu trạng thái kích hoạt của user: 0: chưa kích hoạt, 1: Kích hoạt');            
            $table->string('password')->nullable(FALSE)->comment('Lưu mật khẩu của người quản trị và sử dụng để đăng nhập hệ thống');            
            $table->timestamp('email_verified_at')->nullable();            
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');
            // Đánh index cho 2 trường email, code
            // $table->index('email');            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
