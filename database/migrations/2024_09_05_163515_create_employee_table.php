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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->comment('Lưu họ và tên của nhân viên');
            $table->string('code', 150)->unique()->nullable(false)->comment('Lưu mã của nhân viên, là mã duy nhất không được trung nhau');
            $table->string('email')->unique()->nullable(FALSE)->comment('Lưu email của người quản trị và sử dụng để đăng nhập hệ thống, không được phép trùng');
            $table->string('phone')->unique()->nullable(TRUE)->comment('Lưu số điện thoại của nhân viên');
            $table->date('date_of_birth')->nullable(TRUE)->comment('Lưu ngày sinh của nhân viên');
            $table->text('avatar')->nullable()->default(NULL)->comment('Lưu đường dẫn ảnh của nhân viên');                        
            $table->smallInteger('status')->nullable()->default(0)->comment('Lưu trạng thái hoạt động của tài khoản: 0: Không hoạt động, 1: Hoạt động ');                                    
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');
            // Đánh index cho 2 trường email, code
            $table->index('code');           
            $table->index('email');
            $table->index('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
