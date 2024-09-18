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
        Schema::create('score_adminssions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('leads_id')->unsigned()->nullable(FALSE)->comment('Lưu id của thí sinh');     
            // $table->string('method_name', 255)->nullable()->default(null)->comment('Lưu tên của hình thức xét tuyển: Đào tạo trực tuyến');                   
            // $table->integer('types')->nullable()->default(0)->comment('Lưu kiểm phương thức xét tuyển: 0: xét học bạ, 1: xét bảng điểm đại học - cao đẳng');                   
            $table->bigInteger('form_adminssions_id')->unsigned()->nullable(FALSE)->comment('Lưu id của hình thức xét tuyển: Đào tạo trực tuyến');            
            $table->bigInteger('method_adminssions_id')->unsigned()->nullable(FALSE)->comment('Lưu id của phương thức xét tuyển: Xét học bạ, xét bảng điểm đại học - cao đẳng');                        
            $table->string('province_name', 255)->nullable(FALSE)->comment('Lưu tên thành phố xét tuyển');
            $table->string('school_name', 255)->nullable(FALSE)->comment('Lưu tên trường học tương ứng xét tuyển');
            $table->bigInteger('marjors_id')->nullable(FALSE)->comment('Lưu tên của ngành tốt nghiệp');            
            $table->float('score_avg')->nullable(TRUE)->default(0)->comment('Lưu điểm trung bình xét tuyển'); // tương ứng với xét tuyển bảng điểm đại học
            $table->bigInteger('block_adminssions_id')->unsigned()->nullable(TRUE)->default(NULL)->comment('Lưu id của tổ hợp môn xét học bạ');// tương ứng với xét tuyển học bạ
            $table->float('score1')->nullable(TRUE)->default(0)->comment('Lưu điểm 2 của môn thứ 1 xét tuyển'); // tương ứng với xét tuyển bảng điểm đại học
            $table->float('score2')->nullable(TRUE)->default(0)->comment('Lưu điểm 2 của môn thứ 2 xét tuyển'); // tương ứng với xét tuyển bảng điểm đại học
            $table->float('score3')->nullable(TRUE)->default(0)->comment('Lưu điểm 3 của môn thứ 3 xét tuyển'); // tương ứng với xét tuyển bảng điểm đại học
            $table->float('total_score')->nullable(TRUE)->default(0)->comment('Lưu điểm 3 của môn thứ 3 xét tuyển'); // tương ứng với xét tuyển bảng điểm đại học
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->default(NULL)->comment('Lưu id người tạo mới');
            $table->bigInteger('updated_by')->nullable()->default(NULL)->comment('Lưu id người cập nhật');
            $table->bigInteger('deleted_by')->nullable()->default(NULL)->comment('Lưu id người xóa bỏ');

            $table->foreign('leads_id')->references('id')->on('leads')->onDelete('cascade');            
            $table->foreign('block_adminssions_id')->references('id')->on('block_adminssions')->onDelete('cascade');   
            $table->foreign('form_adminssions_id')->references('id')->on('form_adminssions')->onDelete('cascade');            
            $table->foreign('method_adminssions_id')->references('id')->on('method_adminssions')->onDelete('cascade');   

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_adminssions');
    }
};
