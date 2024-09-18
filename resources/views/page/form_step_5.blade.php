<form id="myForm5" class="col-12" method="POST" action="" data-step="5" style="display:none;">
{{-- <form id="myForm5" class="col-12" method="POST" action="" data-step="5"> --}}
    @csrf
    <h5 class="text-18 mb-4"> Thông tin xét tuyển </h5>
    <h5 class="text-16 mb-2"> Chọn bậc/ Hệ xét tuyển </h5>
    <div class="row mb-3">
        <div class="col-12 date-input-container">
            <div class="radio-input-container">
                <div class="radio-input-wrapper d-flex gap-4">
                    <div class="radio">
                        <input id="radio-1 admission-system" name="admission-system" type="radio" value="1" checked>
                        <label for="radio-1" class="radio-label">Đào tạo trực tuyến</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 35px"></div>

    <h5 class="text-16 mb-2"> Phương thức xét tuyển </h5>
    <div class="row mb-3">
        <div class="col-12 radio-input-container">
            <div class="radio-input-container">
                <div class="radio-input-wrapper d-flex gap-4">
                    <div class="radio">
                        <input id="radio-2" name="admission-method" type="radio" value="1" checked>
                        <label for="radio-2" class="radio-label">Xét học bạ</label>
                    </div>
                    <div class="radio">
                        <input id="radio-3" name="admission-method" type="radio" value="2">
                        <label for="radio-3" class="radio-label">Xét bảng điểm Đại học - Cao đẳng</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 35px"></div>

    <div class="row">
        <div class="col-12">
            <div id="school-records-content" class="school-records-content">
                <div class="school-records-content-title">
                    <p class="text-14" style='font-weight:500'> Thông tin học bạ </p>
                </div>
                <div class="school-records-content-info">
                    <div class="row mb-3">
                        <div class="col-6 select-input-container">
                            <label for="" class="mb-2 select-label text-14">
                                Tỉnh/ Thành phố <span class="required">&#42;</span>
                            </label>
                            <div id="provinces_name_f5_1_wrapper" class="select-input-wrapper">
                                <select name="" id="provinces_name_f5_1" class="col-12">
                                    <option value="">_Chọn_</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                                <p class="error-input"></p>
                            </div>
                        </div>
                        <div class="col-6 select-input-container">
                            <label for="" class="mb-2 select-label text-14">
                                Tên Trường <span class="required">&#42;</span>
                            </label>
                            <div id="school_name_1_wrapper" class="select-input-wrapper">
                                <select name="" id="school_name_1" class="col-12">
                                    <option value="">_Chọn_</option>
                                    <option value="Tên Trường 1">Tên Trường 1</option>
                                    <option value="Tên Trường 2">Tên Trường 2</option>
                                    <option value="Tên Trường 3">Tên Trường 3</option>
                                </select>
                                <p class="error-input"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6 select-input-container">
                            <label for="" class="mb-2 select-label text-14">
                                Ngành <span class="required">&#42;</span>
                            </label>
                            <div id="marjor_f5_1_wrapper" class="select-input-wrapper">
                                <select name="" id="marjor_f5_1" class="col-12">
                                    <option value="">_Chọn_</option>
                                    @foreach($marjors as $marjor)
                                        <option value="{{ $marjor->id }}">{{ $marjor->name }}</option>
                                    @endforeach
                                </select>
                                <p class="error-input"></p>
                            </div>
                        </div>
                        <div class="col-6 select-input-container">
                            <label for="" class="mb-2 select-label text-14">
                                Tổ hợp môn <span class="required">&#42;</span>
                            </label>
                            <div id="block_adminssions_wrapper" class="select-input-wrapper">
                                <select name="" id="block_adminssions" class="col-12">
                                    <option value="">_Chọn_</option>
                                    @foreach($blockAdminssions as $blockAdminssions)
                                        <option value="{{ $blockAdminssions->id }}" data-mons="{{ $blockAdminssions->subject }}">{{ $blockAdminssions->name }}</option>
                                    @endforeach
                                </select>
                                <p class="error-input"></p>
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom: 35px"></div>

                    <p class="text-14" style='font-weight:500'> Nhập điểm trung bình các môn trong tổ hợp môn xét tuyển
                    </p>
                    <div class="row">
                        <div class="d-flex" style="gap:10px;margin-bottom:10px;">
                            <div class="box-1 text-14 text-w-500"> Môn </div>
                            <div class="box-2 text-14 text-w-500 subject"> Toán </div>
                            <div class="box-2 text-14 text-w-500 subject"> Vật lý </div>
                            <div class="box-2 text-14 text-w-500 subject"> Tiếng Anh </div>
                        </div>
                        <div class="d-flex" style="gap:10px;margin-bottom:10px;">
                            <div class="box-1 text-14 text-w-500"> Lớp 12 </div>
                            <input id="score-1" type="number" step="0.1" class="box-2 bg-white" placeholder="10">
                            <input id="score-2" type="number" step="0.1" class="box-2 bg-white" placeholder="10">
                            <input id="score-3" type="number" step="0.1" class="box-2 bg-white" placeholder="10">
                        </div>
                        {{-- <div class="d-flex" style="gap:10px;margin-bottom:10px;">
                            <div class="box-1 text-14 text-w-500"> Điểm trung bình </div>
                            <div class="box-2"> <span class="average-score text-14">10.00</span> </div>
                            <div class="box-2"> <span class="average-score text-14">10.00</span> </div>
                            <div class="box-2"> <span class="average-score text-14">10.00</span> </div>
                        </div> --}}
                        <div class="d-flex" style="gap:10px;margin-bottom:10px;">
                            <div class="box-3 d-flex justify-content-between">
                                <span class="text-14 text-w-500"> Tổng điểm </span>
                                <span class="total-score"> 30.00 </span>
                            </div>
                        </div>
                        <p id="score-error-1" class="error-input"></p>
                        <p id="score-error-2" class="error-input"></p>
                        <p id="score-error-3" class="error-input"></p>
                    </div>
                </div>
            </div>

            <div id="school-scoreboard-content" class="school-scoreboard-content">
                <div class="school-scoreboard-content-title">
                    <p class="text-14" style='font-weight:500'> Thông tin bảng điểm </p>
                </div>
                <div class="school-scoreboard-content-info">
                    <div class="row mb-3">
                        <div class="col-6 select-input-container">
                            <label for="" class="mb-2 select-label text-14">
                                Tỉnh/ Thành phố <span class="required">&#42;</span>
                            </label>
                            <div id="provinces_name_f5_2_wrapper" class="select-input-wrapper">
                                <select name="" id="provinces_name_f5_2" class="col-12">
                                    <option value="">_Chọn_</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                                <p class="error-input"></p>
                            </div>
                        </div>
                        <div class="col-6 select-input-container">
                            <label for="" class="mb-2 select-label text-14">
                                Tên Trường <span class="required">&#42;</span>
                            </label>
                            <div id="school_name_2_wrapper" class="select-input-wrapper">
                                <select name="" id="school_name_2" class="col-12">
                                    <option value="">_Chọn_</option>
                                    <option value="Tên Trường 1">Tên Trường 1</option>
                                    <option value="Tên Trường 2">Tên Trường 2</option>
                                    <option value="Tên Trường 3">Tên Trường 3</option>
                                </select>
                                <p class="error-input"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6 select-input-container">
                            <label for="" class="mb-2 select-label text-14">
                                Ngành <span class="required">&#42;</span>
                            </label>
                            <div id="marjor_f5_2_wrapper" class="select-input-wrapper">
                                <select name="" id="marjor_f5_2" class="col-12">
                                    <option value="">_Chọn_</option>
                                    @foreach($marjors as $marjor)
                                        <option value="{{ $marjor->id }}">{{ $marjor->name }}</option>
                                    @endforeach
                                </select>
                                <p class="error-input"></p>
                            </div>
                        </div>
                        <div class="col-6 text-input-container">
                            <label for="" class="mb-2 date-label">
                                Điểm trung bình <span class="required">&#42;</span>
                            </label>
                            <div id="average_score_wrapper" class="text-input-wrapper">
                                <input class="text-input-custome col-12" type="number" id="average_score"
                                    placeholder="Nhập" aria-label="" />
                                <p class="error-input"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 150px"></div>
    <div class="row">
        <div class="col-12 d-flex gap-3 justify-content-end">
            <button type="button" id="prevStep5" class="button-custome-back">
                <span>&#10140;</span> Quay lại
            </button>
            <button type="submit" class="button-custome-next">
                Tiếp theo <span>&#10140;</span>
            </button>
        </div>
    </div>
</form>
