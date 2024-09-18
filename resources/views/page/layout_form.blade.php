<div class="row">
    <div class="col-4 p-0 banner-info-intro">
        @include('page.form_info_welcome')
        @include('page.form_info_lead')
    </div>
    <div class="col-7">
        <div class="form-container">
            <div class="d-flex align-items-center gap-2 mb-5 tab-container">
                <div id="tab-step-1" class="tab-custome active-tab">
                    Đăng ký hồ sơ
                </div>
                <span style="color:#ccc">&#10095;</span>
                <div id="tab-step-2" class="tab-custome">
                    Thông tin cá nhân
                </div>
                <span style="color:#ccc">&#10095;</span>
                <div id="tab-step-3" class="tab-custome">
                    Thông tin liên lạc
                </div>
                <span style="color:#ccc">&#10095;</span>
                <div id="tab-step-4" class="tab-custome">
                    Thông tin gia đình
                </div>
                <span style="color:#ccc">&#10095;</span>
                <div id="tab-step-5" class="tab-custome">
                    Thông tin xét tuyển
                </div>
                <span style="color:#ccc">&#10095;</span>
                <div id="tab-step-6" class="tab-custome">
                    Xác nhận nộp hồ sơ
                </div>
            </div>
            <div class="form-content">
                {{-- @include('page.form_step_1') --}}
                {{-- @include('page.form_step_2') --}}
                {{-- @include('page.form_step_3') --}}
                {{-- @include('page.form_step_4') --}}
                {{-- @include('page.form_step_5') --}}
                @include('page.form_step_6')
                {{-- @include('page.form_step_final') --}}
            </div>
        </div>
    </div>
    <div class="col-1">
    </div>
</div>