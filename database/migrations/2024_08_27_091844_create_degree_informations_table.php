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
        Schema::create('degree_informations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('leads_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id của thí sinh, sinh viên, khóa ngoại của bảng này quan hệ với id của bảng leads');
            $table->bigInteger('students_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id của thí sinh, sinh viên, khóa ngoại của bảng này quan hệ với id của bảng students');
            $table->string('title')->nullable()->default(NULL)->comment('Lưu tiêu đề của văng bằng: Trình độ văn hóa, Trình độ chuyên môn ');            
            $table->bigInteger('type_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id của kiểu tốt nghiệp (THPT, THCS, Đại Học, Cao Đăng, khóa ngoại quan hệ với bảng educations_types');
            $table->integer('year_of_degree')->nullable()->default(NULL)->comment('Lưu năm cấp bằng');
            $table->date('date_of_degree')->nullable()->default(NULL)->comment('Lưu ngày cấp bằng');
            $table->string('place_of_degree')->nullable()->default(NULL)->comment('Lưu tên trường cấp bằng');            
            $table->string('serial_number_degree')->nullable()->default(NULL)->comment('Lưu số văn bằng tốt nghiệp');            
            $table->smallInteger('status')->nullable()->default(1)->comment('Lưu trạng thái hoạt động của văng bằng: 0: Không hoạt động, 1: Hoạt động ');
            $table->text('avatar')->nullable()->default(NULL)->comment('Lưu đường dẫn ảnh bằng tốt nghiệp');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');
            //Quản hệ với các bảng
            $table->foreign('leads_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('educations_types')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('degree_informations');
    }
};
