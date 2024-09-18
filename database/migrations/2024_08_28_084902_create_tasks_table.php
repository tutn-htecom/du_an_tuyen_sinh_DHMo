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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->unsigned()->nullable()->comment('Lưu id của nhân viên');
            $table->string('title')->nullable(false)->comment('Lưu tiêu đề của task');                        
            $table->text('description')->nullable(false)->comment('Lưu mô tả của task');                        
            $table->date('start_date')->nullable(false)->comment('Lưu ngày của sự kiện');
            $table->date('due_date')->nullable()->default(NULL)->comment('Lưu thời gian của sự kiện');            
            $table->tinyInteger('status')->nullable()->comment('Trạng thái');                 
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');
            
            //Quan hệ với bảng provinces
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
