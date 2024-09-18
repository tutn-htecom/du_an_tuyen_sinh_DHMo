# Tạo Migration 
2024_09_19_001037_create_steps_collumn.php

# Khai báo const tại model leads
    const REGISTER_PROFILE = 1;
    const INFORMATION_PROFILE = 2;
    const CONTACTS = 3;
    const FAMILY = 4;
    const SCORE = 5;
    const CONFIRM = 6;
# Gán biến với steps với các biến const theo từng bước

# Bước 1: Đăng ký hồ sơ: action_insert()
    "steps"         => Leads::REGISTER_PROFILE,

# Bước 2: Thông tin hồ sơ: uPersonal()
    "steps"         => Leads::REGISTER_PROFILE,

    // Kiểm tra id có tồn tại trong bảng leads không
    // -------------------------------------------------
    // Kiểm tra lead có id tồn tại không
    $dem = $this->leads_repository->where('id', $id)->count();
    if($dem <= 0) {
        return [
            "code" => 422,
            "message" => "Không tim thấy thí sinh trên hệ thống",
        ];
    }
    // -------------------------------------------------
# Bước 3: Thông tin liên lạc contacts(): 
    // Bổ sung thêm 
    // --------------------------------------------
    $steps = [
        "steps"         => Leads::CONTACTS,
    ];
    $this->leads_repository->updateById($id, $steps);

    // --------------------------------------------
# Bước 4: Thông tin liên lạc family(): 
    // Bổ sung thêm 
    // --------------------------------------------
    $steps = [
        "steps"         => Leads::FAMILY,
    ];
    $this->leads_repository->updateById($id, $steps);

    // --------------------------------------------

# Bước 5: Thông tin xét tuyển: score();
    // Bổ sung thêm 
    // --------------------------------------------
    $steps = [
        "steps"         => Leads::SCORE,
    ];
    $this->leads_repository->updateById($id, $steps);

    // --------------------------------------------

# Bước 6: Xác nhận hồ sơ: confirm()
    // Bổ sung thêm 
    // --------------------------------------------
    $steps = [
        "steps"         => Leads::SCORE,
    ];
    $this->leads_repository->updateById($id, $steps);

    // --------------------------------------------

# Xử lý login