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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(FALSE)->comment('Lưu họ và tên nhân viên');
            $table->string('code', 150)->unique()->nullable(FALSE)->comment('Lưu slug của từng phần, mỗi slug duy nhất không trùng nhau');            
            $table->smallInteger('type')->nullable(true)->default(0)->comment('Lưu slug của từng phần, mỗi slug duy nhất không trùng nhau');            
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');            
            $table->index('name');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
