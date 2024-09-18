{{-- <form id="myForm3" class="col-12" method="POST" action="" data-step="3" style="display:none;"> --}}
<form id="myForm3" class="col-12" method="POST" action="" data-step="3">
    @csrf
    <h5 class="text-18 mb-4"> Thông tin liên lạc </h5>
    <h5 class="text-16 mb-2"> Hộ khẩu thường trú </h5>
    <div class="row mb-3">
        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Tỉnh/ Thành phố <span class="required">&#42;</span>
            </label>
            <div id="provinces_name_1_wrapper" class="select-input-wrapper">
                <select name="" id="provinces_name_1" class="col-12">
                    <option value="">_Chọn_</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province['name'] }}">{{ $province['name'] }}</option>
                    @endforeach
                </select>
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Quận/ Huyện <span class="required">&#42;</span>
            </label>
            <div id="districts_name_1_wrapper" class="select-input-wrapper">
                <select name="" id="districts_name_1" class="col-12">
                    <option value="">_Chọn_</option>
                </select>
                <p class="error-input"></p>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Phường/ Xã <span class="required">&#42;</span>
            </label>
            <div id="wards_name_1_wrapper" class="select-input-wrapper">
                <select name="" id="wards_name_1" class="col-12">
                    <option value="">_Chọn_</option>
                </select>
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Địa chỉ <span class="required">&#42;</span>
            </label>
            <div id="address_1_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="text" id="address_1" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 35px"></div>

    <h5 class="text-16 mb-2"> Địa chỉ liên lạc </h5>
    <div class="row mb-3">
        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Tỉnh/ Thành phố <span class="required">&#42;</span>
            </label>
            <div id="provinces_name_2_wrapper" class="select-input-wrapper">
                <select name="" id="provinces_name_2" class="col-12">
                    <option value="">_Chọn_</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province['name'] }}">{{ $province['name'] }}</option>
                    @endforeach
                </select>
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Quận/ Huyện <span class="required">&#42;</span>
            </label>
            <div id="districts_name_2_wrapper" class="select-input-wrapper">
                <select name="" id="districts_name_2" class="col-12">
                    <option value="">_Chọn_</option>
                </select>
                <p class="error-input"></p>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 select-input-container">
            <label for="" class="mb-2 date-label">
                Phường/ Xã <span class="required">&#42;</span>
            </label>
            <div id="wards_name_2_wrapper" class="select-input-wrapper">
                <select name="" id="wards_name_2" class="col-12">
                    <option value="">_Chọn_</option>
                </select>
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Địa chỉ <span class="required">&#42;</span>
            </label>
            <div id="address_2_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="text" id="address_2" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 35px"></div>

    <h5 class="text-16 mb-2"> Số điện thoại </h5>
    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Số điện thoại cá nhân <span class="required">&#42;</span>
            </label>
            <div class="text-input-wrapper">
                <input class="text-input-custome col-12" type="tel" id="personal_phone" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Số điện thoại nhà riêng
            </label>
            <div class="text-input-wrapper">
                <input class="text-input-custome col-12" type="tel" id="home_phone" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>
    </div>

    <div style="margin-bottom: 150px"></div>
    <div class="row">
        <div class="col-12 d-flex gap-3 justify-content-end">
            <button type="button" id="prevStep3" class="button-custome-back">
                <span>&#10140;</span> Quay lại
            </button>
            <button type="submit" class="button-custome-next">
                Tiếp theo <span>&#10140;</span>
            </button>
        </div>
    </div>
</form>

<script> var provincesData = <?= json_encode($provinces); ?>; </script>