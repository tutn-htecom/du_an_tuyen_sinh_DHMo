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
        Schema::create('nations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(FALSE)->comment('Lưu tên của quốc gia');
            // $table->string('slug', 150)->unique()->nullable()->default(NULL)->comment('Lưu tên viết tắt của quốc gia');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nations');
    }
};
