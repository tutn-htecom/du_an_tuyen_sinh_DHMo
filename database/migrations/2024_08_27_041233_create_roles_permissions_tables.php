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
        Schema::create('roles_permissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('permissions_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id người quản trị được phần quyền');
            $table->bigInteger('roles_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id ở bảng phần quyền');
            // Tạo quan hệ với bảng users            
            $table->foreign('permissions_id')->references('id')->on('permissions')->onDelete('cascade');
            // Tạo quan hệ với bảng permissions
            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_permissions');
    }
};
