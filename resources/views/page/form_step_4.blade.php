{{-- <form id="myForm4" class="col-12" method="POST" action="" data-step="4" style="display:none;"> --}}
<form id="myForm4" class="col-12" method="POST" action="" data-step="4">
    @csrf
    <h5 class="text-18 mb-4"> Thông tin gia đình </h5>
    <h5 class="text-16 mb-2"> Thông tin cha </h5>
    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Họ và tên cha <span class="required">&#42;</span>
            </label>
            <div id="father_full_name_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="text" id="father_full_name" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Năm sinh
            </label>
            <div id="father_yearOfBirth_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="number" id="father_yearOfBirth" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Số điện thoại <span class="required">&#42;</span>
            </label>
            <div id="father_phone_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="number" id="father_phone" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Nghề nghiệp
            </label>
            <div id="father_job_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="text" id="father_job" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 select-input-container">
            <label for="" class="mb-2 date-label">
                Trình độ học vấn
            </label>
            <div id="father_education_wrapper" class="select-input-wrapper">
                <select name="" id="father_education" class="col-12">
                    <option value="">_Chọn_</option>
                    <option value="1">Trình độ học vấn 1</option>
                    <option value="2">Trình độ học vấn 2</option>
                    <option value="3">Trình độ học vấn 3</option>
                </select>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 35px"></div>

    <h5 class="text-16 mb-2"> Thông tin mẹ </h5>
    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Họ và tên mẹ <span class="required">&#42;</span>
            </label>
            <div id="mother_full_name_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="text" id="mother_full_name" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Năm sinh
            </label>
            <div id="mother_yearOfBirth_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="number" id="mother_yearOfBirth" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Số điện thoại <span class="required">&#42;</span>
            </label>
            <div id="mother_phone_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="number" id="mother_phone" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Nghề nghiệp
            </label>
            <div id="mother_job_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="text" id="mother_job" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 select-input-container">
            <label for="" class="mb-2 date-label">
                Trình độ học vấn
            </label>
            <div id="mother_education_wrapper" class="select-input-wrapper">
                <select name="" id="mother_education" class="col-12">
                    <option value="">_Chọn_</option>
                    <option value="1">Trình độ học vấn 1</option>
                    <option value="2">Trình độ học vấn 2</option>
                    <option value="3">Trình độ học vấn 3</option>
                </select>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 35px"></div>

    <h5 class="text-16 mb-2"> Thông vợ hoặc chồng </h5>
    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Họ và tên
            </label>
            <div id="name_wifeOrHusband_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="text" id="name_wifeOrHusband" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Năm sinh
            </label>
            <div id="yearOfBirth_wifeOrHusband_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="number" id="yearOfBirth_wifeOrHusband" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Số điện thoại
            </label>
            <div id="phone_wifeOrHusband_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="number" id="phone_wifeOrHusband" placeholder="Nhập"
                    aria-label="" />
                <p class="error-input"></p>
            </div>
        </div>

        <div class="col-6 text-input-container">
            <label for="" class="mb-2 date-label">
                Nghề nghiệp
            </label>
            <div id="job_wifeOrHusband_wrapper" class="text-input-wrapper">
                <input class="text-input-custome col-12" type="text" id="job_wifeOrHusband" placeholder="Nhập"
                    aria-label="" />
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 select-input-container">
            <label for="" class="mb-2 date-label">
                Trình độ học vấn
            </label>
            <div id="wifeOrHusband_education_wrapper" class="select-input-wrapper">
                <select name="" id="wifeOrHusband_education" class="col-12">
                    <option value="">_Chọn_</option>
                    <option value="1">Trình độ học vấn 1</option>
                    <option value="2">Trình độ học vấn 2</option>
                    <option value="3">Trình độ học vấn 3</option>
                </select>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 150px"></div>
    <div class="row">
        <div class="col-12 d-flex gap-3 justify-content-end">
            <button type="button" id="prevStep4" class="button-custome-back">
                <span>&#10140;</span> Quay lại
            </button>
            <button type="submit" class="button-custome-next">
                Tiếp theo <span>&#10140;</span>
            </button>
        </div>
    </div>
</form>
