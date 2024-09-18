<form id="myForm2" class="col-12" method="POST" action="" data-step="2">
{{-- <form id="myForm2" class="col-12" method="POST" action="" data-step="2" style="display:none"> --}}
    @csrf
    <h5 class="text-18 mb-4"> Thông tin cá nhân </h5>
    <div class="text-input-container">
        <div class="col-6 avatar-upload-container">
            <label for="" class="mb-2 date-label">
                Ảnh chân dung <span class="required">&#42;</span>
            </label>
            <div class="d-flex gap-3 align-items-end flex-wrap avatar-wrapper">
                <img id="avatar-preview" src="/assets/image/avatar.png" alt="Ảnh chân dung">
                <input name="" id="avatar-upload" type="file" accept="image/*">
                <p class="error-input"></p>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 35px"></div>

    <h5 class="text-18 mb-2"> Thông tin giấy tờ </h5>
    <div class="row mb-3">
        <div class="col-6 date-input-container">
            <label for="" class="mb-2 date-label">
                Ngày sinh <span class="required">&#42;</span>
            </label>
            <div id="date_of_birth_f2_wrapper" class="date-input-wrapper">
                <input name="date_of_birth" class="input-custome-date col-12" type="date" id="date_of_birth_f2" placeholder="dd/mm/yyyy"
                    aria-label="Date of birth" />
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Nơi sinh (Tỉnh/Thành phố ghi theo giấy khai sinh) <span class="required">&#42;</span>
            </label>
            <div id="place_of_birth_f2_wrapper" class="select-input-wrapper">
                <select name="place_of_birth" id="place_of_birth_f2" class="col-12">
                    <option value="">_Chọn_</option>
                    @foreach($cities as $city)
                        <option value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                    @endforeach
                    <option value="Khác">Khác</option>
                </select>
                <p class="error-input"></p>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Quốc tịch <span class="required">&#42;</span>
            </label>
            <div id="nations_name_wrapper" class="select-input-wrapper">
                <select name="nations_name" id="nations_name" class="col-12">
                    <option value="">_Chọn_</option>
                    <option value="Việt Nam">Việt Nam</option>
                    <option value="Khác">Khác</option>
                </select>
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Dân tộc <span class="required">&#42;</span>
            </label>
            <div id="ethnics_name_wrapper" class="select-input-wrapper">
                <select name="ethnics_name" id="ethnics_name" class="col-12">
                    <option value="">_Chọn_</option>
                    @foreach($ethnics as $ethnic)
                        @if($ethnic['name'] != '-')
                            <option value="{{ $ethnic['name'] }}">{{ $ethnic['name'] }}</option>
                        @endif
                    @endforeach
                    <option value="Khác">Khác</option>
                </select>
                <p class="error-input"></p>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                CMND/ CCCD <span class="required">&#42;</span>
            </label>
            <div id="identification_card_f2_wrapper" class="text-input-wrapper">
                <input name="identification_card" class="text-input-custome col-12" type="text" id="identification_card_f2" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 select-input-container">
            <div class="row">
                <div class="col-6 date-input-container">
                    <label for="" class="mb-2 date-label">
                        Ngày cấp <span class="required">&#42;</span>
                    </label>
                    <div id="date_identification_card_wrapper" class="date-input-wrapper">
                        <input name="date_identification_card" class="input-custome-date col-12" type="date" id="date_identification_card" placeholder="dd/mm/yyyy"
                            aria-label="" />
                        <p class="error-input"></p>
                    </div>
                </div>
                <div class="col-6 select-input-container">
                    <label for="" class="mb-2 date-label">
                        Nơi cấp <span class="required">&#42;</span>
                    </label>
                    <div id="place_identification_card_wrapper" class="select-input-wrapper">
                        <select name="place_identification_card" id="place_identification_card" class="col-12">
                            <option value="">_Chọn_</option>
                            @foreach($cities as $city)
                                <option value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                            @endforeach
                            <option value="Khác">Khác</option>
                        </select>
                        <p class="error-input"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 35px"></div>

    <h5 class="text-18 mb-2"> Đoàn thể/ Đảng </h5>
    <div class="row mb-3">
        <div class="col-6 date-input-container">
            <label for="" class="mb-2 date-label">
                Ngày kết nạp Đoàn
            </label>
            <div class="date-input-wrapper">
                <input name="date_of_join_youth_union" class="input-custome-date col-12" type="date" id="date_of_join_youth_union" placeholder="dd/mm/yyyy"
                    aria-label="" />
            </div>
        </div>

        <div class="col-6 date-input-container">
            <label for="" class="mb-2 date-label">
                Ngày kết nạp Đảng
            </label>
            <div class="date-input-wrapper">
                <input name="date_of_join_communist_party" class="input-custome-date col-12" type="date" id="date_of_join_communist_party" placeholder="dd/mm/yyyy"
                    aria-label="" />
            </div>
        </div>
    </div>
    <div style="margin-bottom: 35px"></div>

    <h5 class="text-18 mb-2"> Thông tin làm việc</h5>
    <div class="row">
        <div class="mb-3 text-input-container">
            <label for="" class="mb-2 date-label">
                Địa chỉ email
            </label>
            <div class="text-input-wrapper">
                <input name="email" class="text-input-custome col-12" type="text" id="email_f2" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Tên cơ quan làm việc
            </label>
            <div class="text-input-wrapper">
                <input name="company_name" class="text-input-custome col-12" type="text" id="company_name" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Địa chỉ cơ quan làm việc
            </label>
            <div class="text-input-wrapper">
                <input name="company_address" class="text-input-custome col-12" type="text" id="company_address" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>
    </div>
    <div style="margin-bottom: 35px"></div>

    <h5 class="text-18 mb-2"> Trình độ văn hóa </h5>
    <div class="row mb-3">
        <div class="col-12 select-input-container">
            <label for="" class="mb-2 date-label">
                Bằng tốt nghiệp (THPT, BTTH)
            </label>
            <div class="select-input-wrapper">
                <select name="type_id_1" id="type_id_1" class="col-12">
                    <option value="">_Chọn_</option>
                    <option value="Bằng tốt nghiệp 1">Bằng tốt nghiệp 1</option>
                    <option value="Bằng tốt nghiệp 2">Bằng tốt nghiệp 2</option>
                    <option value="Bằng tốt nghiệp 3">Bằng tốt nghiệp 3</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Năm tốt nghiệp
            </label>
            <div class="text-input-wrapper">
                <input name="year_of_degree_1" class="text-input-custome col-12" type="text" id="year_of_degree_1" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Số văn bằng
            </label>
            <div class="text-input-wrapper">
                <input name="serial_number_degree_1" class="text-input-custome col-12" type="text" id="serial_number_degree_1" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 date-input-container">
            <label for="" class="mb-2 date-label">
                Ngày cấp
            </label>
            <div class="date-input-wrapper">
                <input name="date_of_degree_1" class="input-custome-date col-12" type="date" id="date_of_degree_1" placeholder="dd/mm/yyyy"
                    aria-label="" />
            </div>
        </div>
        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Nơi cấp
            </label>
            <div class="select-input-wrapper">
                <select name="place_of_degree_1" id="place_of_degree_1" class="col-12">
                    <option value="">_Chọn_</option>
                    <option value="Việt Nam">Việt Nam</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 35px"></div>

    <h5 class="text-18 mb-2"> Trình độ chuyên môn </h5>
    <div class="row mb-3">
        <div class="col-12 date-input-container">
            <label for="" class="mb-2 date-label">
                Đã tốt nghiệp
            </label>
            <div class="radio-input-container">
                <div class="radio-input-wrapper d-flex gap-4">
                    <div class="radio">
                        <input id="radio-1" name="type_id_2" type="radio" value="1" checked>
                        <label for="radio-1" class="radio-label">Trung cấp chuyên nghiệp</label>
                    </div>
                    <div class="radio">
                        <input id="radio-2" name="type_id_2" type="radio" value="2">
                        <label for="radio-2" class="radio-label">Trung cấp Nghề</label>
                    </div>
                    <div class="radio">
                        <input id="radio-3" name="type_id_2" type="radio" value="3">
                        <label for="radio-3" class="radio-label">Cao đẳng</label>
                    </div>
                    <div class="radio">
                        <input id="radio-4" name="type_id_2" type="radio" value="4">
                        <label for="radio-4" class="radio-label">Đại học</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Năm tốt nghiệp
            </label>
            <div class="text-input-wrapper">
                <input name="year_of_degree_2" class="text-input-custome col-12" type="text" id="year_of_degree_2" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Số văn bằng
            </label>
            <div class="text-input-wrapper">
                <input name="serial_number_degree_2" class="text-input-custome col-12" type="text" id="serial_number_degree_2" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 date-input-container">
            <label for="" class="mb-2 date-label">
                Ngày cấp
            </label>
            <div class="date-input-wrapper">
                <input name="date_of_degree_2" class="input-custome-date col-12" type="date" id="date_of_degree_2" placeholder="dd/mm/yyyy"
                    aria-label="" />
            </div>
        </div>
        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Nơi cấp
            </label>
            <div class="select-input-wrapper">
                <select name="place_of_degree_2" id="place_of_degree_2" class="col-12">
                    <option value="">_Chọn_</option>
                    <option value="Việt Nam">Việt Nam</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center gap-2">
            <input type="checkbox" style="width:15px;height:15px;">
            <span> Đã đi làm </span>
        </div>
    </div>

    <div style="margin-bottom: 150px"></div>
    <div class="row">
        <div class="col-12 d-flex gap-3 justify-content-end">
            <button type="button" id="prevStep2" class="button-custome-back">
                <span>&#10140;</span> Quay lại
            </button>
            <button type="submit" class="button-custome-next">
                Tiếp theo <span>&#10140;</span>
            </button>
        </div>
    </div>
</form>
