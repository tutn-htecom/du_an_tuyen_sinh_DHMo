{{-- <form id="myForm6" class="col-12" method="POST" action="" data-step="6" style="display:none;"> --}}
<form id="myForm6" class="col-12" method="POST" action="" data-step="6">
    @csrf
    <h5 class="text-18 mb-4"> Xác nhận nộp hồ sơ </h5>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="text-14 text-w-500 upload-scan-text"> Upload ảnh scan giấy tờ bao gồm </div>
            <div class="upload-scan-img">
                <div class="d-flex gap-3 upload-img-wrapper mb-4">
                    <div class="img-upload-preview">
                        <img src="/assets/image/img-example.png" alt="">
                    </div>
                    <div class="fileUpload">
                        <input type="file" class="upload" id="input-upload-f6" multiple />
                        <span><i class="fa fa-plus"></i></span>aaaaaa
                    </div>
                </div>
                <div class="text-note">
                    <p class="text-14">* Hình ảnh giấy tờ bao gồm: Bằng tốt nghiệp THPT hoặc Giấy chứng nhận tốt nghiệp
                        tạm thời (có công chứng), Ảnh 2 mặt CMND/CCCD, Học bạ THPT.</p>
                </div>
            </div>
        </div>
        <div class="col-12 text-note-2">
            <p class="text-14">Sinh viên chú ý, phải tiến hành lưu thông tin trước khi in phiếu thông tin. Nếu chưa thực
                hiện lưu thông tin, phiếu thông tin sẽ có dòng chữ "Bản xem trước" và phiếu thông tin này là không hợp
                lệ.</p>
        </div>
    </div>

    <div style="margin-bottom: 150px"></div>
    <div class="row">
        <div class="col-12 d-flex gap-3 justify-content-end">
            <button type="button" id="prevStep6" class="button-custome-back">
                <span>&#10140;</span> Quay lại
            </button>
            <button type="submit" class="button-custome-next">
                Xác nhận nộp <img src="/assets/image/check.png" alt="">
            </button>
        </div>
    </div>
</form>
