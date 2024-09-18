{{-- <form id="myForm1" class="col-12" method="POST" action="/register/step" data-step="1"> --}}
<form id="myForm1" class="col-12" method="POST" action="/submit-form-1" data-step="1">
    @csrf
    <h5 class="text-18 mb-4"> Đăng ký hồ sơ </h5>
    <div class="mb-3 text-input-container">
        <label for="" class="mb-2 date-label">
            Địa chỉ email <span class="required">&#42;</span>
        </label>
        <div id="email-wrapper" class="text-input-wrapper">
            <input name="email" class="text-input-custome col-12" type="text" id="email" placeholder="Nhập"
                aria-label="" />
            <p class="error-input"></p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Họ và tên <span class="required">&#42;</span>
            </label>
            <div id="fullname-wrapper" class="text-input-wrapper">
                <input name="full_name" class="text-input-custome col-12" type="text" id="fullname" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 date-input-container">
            <label for="" class="mb-2 date-label">
                Ngày sinh <span class="required">&#42;</span>
            </label>
            <div id="dateOfBirth-wrapper" class="date-input-wrapper">
                <input name="date_of_birth" class="input-custome-date col-12" type="date" id="dateOfBirth" placeholder="dd/mm/yyyy"
                    aria-label="Date of birth" />
                <p class="error-input"></p>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Giới tính <span class="required">&#42;</span>
            </label>
            <div id="gender-wrapper" class="select-input-wrapper">
                <select name="gender" id="gender" class="col-12">
                    <option value="">_Chọn_</option>
                    <option value="0">Nữ</option>
                    <option value="1">Nam</option>
                    <option value="2">Khác</option>
                </select>
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Số điện thoại <span class="required">&#42;</span>
            </label>
            <div id="phone-wrapper" class="text-input-wrapper">
                <input name="phone" class="text-input-custome col-12" type="text" id="phone" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                CMND/ CCCD <span class="required">&#42;</span>
            </label>
            <div id="identificationCard-wrapper" class="text-input-wrapper">
                <input name="identification_card" class="text-input-custome col-12" type="text" id="identificationCard" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Nơi sinh <span class="required">&#42;</span>
            </label>
            <div id="placeOfBirth-wrapper" class="select-input-wrapper">
                <select name="place_of_birth" id="placeOfBirth" class="col-12">
                    <option value="">_Chọn_</option>
                    @foreach($cities as $city)
                        <option value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                    @endforeach
                </select>
                <p class="error-input"></p>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Nơi đang làm việc/ học tập <span class="required">&#42;</span>
            </label>
            <div id="placeOfWorkLearn-wrapper" class="text-input-wrapper">
                <input name="place_of_wrk_lrn" class="text-input-custome col-12" type="text" id="placeOfWorkLearn" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Nguồn tiếp cận chương trình <span class="required">&#42;</span>
            </label>
            <div id="source-wrapper" class="select-input-wrapper">
                <select name="sources_id" id="source" class="col-12">
                    <option value="">_Chọn_</option>
                    @foreach($sources as $source)
                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                    @endforeach
                </select>
                <p class="error-input"></p>
            </div>
        </div>
    </div>
    <div class="mb-3 text-input-container">
        <div class="col-12 select-input-container">
            <label for="" class="mb-2 date-label">
                Ngành đăng ký <span class="required">&#42;</span>
            </label>
            <div id="marjor-wrapper" class="select-input-wrapper">
                <select name="marjors_id" id="marjor" class="col-12">
                    <option value="">_Chọn_</option>
                    @foreach($marjors as $marjor)
                        <option value="{{ $marjor->id }}">{{ $marjor->name }}</option>
                    @endforeach
                </select>
                <p class="error-input"></p>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 150px"></div>
    <div class="row">
        <div class="col-12 d-flex gap-3 justify-content-end">
            <button type="submit" class="button-custome-next">
                Đăng ký <span>&#10140;</span>
            </button>
        </div>
    </div>
</form>