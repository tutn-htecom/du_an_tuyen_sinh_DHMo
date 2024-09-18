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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->string('code', 150)->unique()->nullable(FALSE)->comment('Lưu mã yêu cầu hỗ trợ');
            $table->bigInteger('leads_id')->unsigned()->nullable(TRUE)->default(NULL)->comment('Lưu id của sinh viên hoặc thí sinh');
            $table->bigInteger('students_id')->unsigned()->nullable(TRUE)->default(NULL)->comment('Lưu id của sinh viên hoặc thí sinh');
            $table->string('subject', 255)->nullable(FALSE)->comment('Tiêu đề hỗ trợ');            
            $table->text('descriptions')->nullable(TRUE)->default(NULL)->comment('Lưu mô tả, nội dung cần hỗ trợ');
            $table->bigInteger('tags_id')->unsigned()->nullable(TRUE)->default(NULL)->comment('Lưu id thẻ của support');
            $table->bigInteger('employees_id')->unsigned()->nullable(TRUE)->default(NULL)->comment('Lưu id người chỉ định hỗ trợ của support');
            $table->string('send_to', 255)->nullable(TRUE)->comment('Lưu email gửi đến người cần hỗ trợ, TH: nếu để trông thì sẽ gửi đến email theo id request');
            $table->string('send_cc', 255)->nullable(TRUE)->comment('Lưu email gửi cc người cần biết thông tin');
            $table->bigInteger('sp_status_id')->unsigned()->nullable(TRUE)->default(1)->comment('Lưu lại trạng thái của yêu cầu hỗ trợ');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');
            $table->foreign('leads_id')->references('id')->on('leads')->onDelete('cascade'); // Thí sinh
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade'); // Sinh viên
            $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade'); // Thẻ
            $table->foreign('employees_id')->references('id')->on('employees')->onDelete('cascade'); // nhân viên
            $table->foreign('sp_status_id')->references('id')->on('supports_status')->onDelete('cascade'); // trạng thái
            $table->index('code'); 
            $table->index('subject'); 
            $table->index('sp_status_id');             
            $table->index('employees_id');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};

