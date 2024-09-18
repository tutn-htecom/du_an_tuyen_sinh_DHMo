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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable(TRUE)->default(NULL)->comment('Lưu họ tên của Thí sinh, sinh viên');            
            $table->string('code', 150)->unique()->nullable(TRUE)->default(NULL)->comment('Lưu mã hồ sơ');
            $table->string('email', 150)->unique()->nullable(FALSE)->comment('Lưu email của người quản trị và sử dụng để đăng nhập hệ thống, không được phép trùng');
            $table->string('phone')->unique()->nullable(TRUE)->comment('Lưu số điện thoại của Thí sinh, sinh viên');
            $table->string('home_phone')->unique()->nullable(TRUE)->comment('Lưu số điện thoại nhà riêng của Thí sinh, sinh viên');
            $table->text('avatar')->nullable(TRUE)->comment('Lưu đường dẫn ảnh của Thí sinh, sinh viên');
            $table->date('date_of_birth')->nullable(TRUE)->comment('Lưu email của người quản trị và sử dụng để đăng nhập hệ thống, không được phép trùng');
            $table->tinyInteger('gender')->nullable(TRUE)->comment('Lưu giới tính của Thí sinh, sinh viên: 0: nữ, 1: nam, 2: khác');
            $table->string('identification_card')->nullable(TRUE)->comment('Lưu số CCCD của Thí sinh, sinh viên');
            $table->date('date_identification_card')->nullable(TRUE)->comment('Lưu ngày cấp của CCCD');
            $table->string('place_identification_card')->nullable(TRUE)->comment('Nơi cấp CCCD của Thí sinh, sinh viên');
            $table->string('place_of_birth')->nullable(TRUE)->comment('Lưu nơi sinh của Thí sinh, sinh viên');
            $table->string('place_of_wrk_lrn')->nullable(TRUE)->comment('Lưu nơi làm việc / học tập của Thí sinh, sinh viên');
            //Khóa quan hệ
            $table->bigInteger('sources_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id của nguồn tiếp cận chương trình, là khóa ngoại quan hệ với bảng sources');
            $table->bigInteger('marjors_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id của ngành học, là khóa ngoại quan hệ với bảng majors');            
            $table->string('nations_name')->nullable()->default(NULL)->comment('Lưu id của quốc gia');
            $table->string('ethnics_name')->nullable()->default(NULL)->comment('Lưu id của dân tộc');
            
            // Ngày tham gia vào đoàn thanh niên
            $table->date('date_of_join_youth_union')->nullable()->default(NULL)->comment('Lưu ngày kết nạp đoàn thanh niên');
            // Ngày tham gia vào đoàn thanh niên
            $table->date('date_of_join_communist_party')->nullable()->default(NULL)->comment('Lưu ngày kết nạp đảng');
            // Tên cơ quan làm việc
            $table->string('company_name')->nullable()->default(NULL)->comment('Lưu tên công ty đang làm việc');
            $table->string('company_address')->nullable()->default(NULL)->comment('Lưu địa chỉ công ty đang làm việc');
            $table->bigInteger('lst_status_id')->unsigned()->nullable()->default(0)->comment('Lưu  id trạng thái, là khóa ngoại quan hệ với bảng status');
            $table->bigInteger('tags_id')->unsigned()->nullable()->default(NULL)->comment('Lưu id thẻ, sử dụng để gắn tìm kiếm');
            // Trình độ văn hóa - Trình độ chuyên môn - Phat sinh ra bảng mới degree_informationsh                     
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->unsigned()->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');
            
            $table->foreign('sources_id')->references('id')->on('sources')->onDelete('cascade'); // Nguồn tiếp cận
            $table->foreign('marjors_id')->references('id')->on('marjors')->onDelete('cascade'); // Chuyên ngành đào tạo
            // $table->foreign('nations_id')->references('id')->on('nations')->onDelete('cascade'); // Quóc gia
            // $table->foreign('ethnics_id')->references('id')->on('ethnics')->onDelete('cascade'); // Dân tộc
            $table->foreign('lst_status_id')->references('id')->on('lst_status')->onDelete('cascade'); // trạng thái cả sinh viên và thí sinh           
            $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade'); // thẻ 
            
            // đánh index
            $table->index('email'); 
            $table->index('phone'); 
        });       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
