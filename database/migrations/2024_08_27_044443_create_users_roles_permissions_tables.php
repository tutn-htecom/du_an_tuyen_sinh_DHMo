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
        Schema::create('users_roles_permissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id người quản trị là khóa phụ để quản hệ với bảng users');
            $table->bigInteger('roles_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id vai trò là khóa phụ quan hệ với bảng roles');
            $table->bigInteger('permissions_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id ở bảng phần quyền, là khóa phụ để quan hệ với bảng permissions');
            // Tạo quan hệ với bảng users            
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');            
            // Tạo quan hệ với bảng roles
            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade');            
            // Tạo quan hệ với bảng permissions
            $table->foreign('permissions_id')->references('id')->on('permissions')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_roles_permissions');
    }
};
