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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('provinces_id')->unsigned()->nullable(False)->comment('Lưu province id của cấp Quận / Huyện trực thuộc Tỉnh / Thành Phố tương ứng');
            // $table->integer('districts_id')->nullable(False)->comment('Lưu province id của cấp Quận / Huyện trực thuộc Quận / Huyện');
            $table->string('districts_name')->nullable(False)->comment('Lưu tên của Tỉnh/ Thành phố');
            $table->string('districts_code', 150)->nullable(False)->comment('Lưu code của Quận / Huyện ');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');

            //Quan hệ với bảng provinces
            $table->foreign('provinces_id')->references('id')->on('provinces')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
