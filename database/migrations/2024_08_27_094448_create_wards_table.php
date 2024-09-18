<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {        
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('districts_id')->unsigned()->nullable(False)->comment('Lưu districts id của Quận / Huyện tương ứng');
            // $table->integer('wards_id')->nullable(False)->comment('Lưu province id của cấp cấp Phường/ Xã trực thuộc cấp Phường/ Xã');
            $table->string('wards_name')->nullable(False)->comment('Lưu tên của Tỉnh/ Thành phố');
            $table->string('wards_code', 150)->nullable(False)->comment('Lưu code của cấp Phường/ Xã ');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');
            //Quan hệ với bảng provinces
            $table->foreign('districts_id')->references('id')->on('districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};
