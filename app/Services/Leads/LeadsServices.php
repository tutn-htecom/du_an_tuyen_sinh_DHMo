<?php

namespace App\Services\Leads;

use App\Exports\LeadsExport;
use App\Imports\LeadsImport;
use App\Imports\LeadsImports;
use App\Models\Contacts;
use App\Models\FamilyInformations;
use App\Models\Leads;
use App\Models\User;
use App\Repositories\ContactsRepository;
use App\Repositories\DegreeRepository;
use App\Repositories\FamilyRepository;
use App\Repositories\FilesRepository;
use App\Repositories\LeadsRepository;
use App\Repositories\ScoreAdminssionRepository;
use App\Repositories\SupportsRepository;
use App\Repositories\UserRepository;
use App\Services\Leads\LeadsInterface;
use App\Traits\General;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class LeadsServices implements LeadsInterface
{
    use General;
    protected $leads_repository;
    protected $degree_repository;
    protected $contacts_repository;
    protected $family_repository;
    protected $score_repository;
    protected $file_repository;
    protected $user_repository;
    protected $support_repository;
    public function __construct(
        LeadsRepository $leads_repository,
        DegreeRepository $degree_repository,
        ContactsRepository $contacts_repository,
        FamilyRepository $family_repository,
        ScoreAdminssionRepository $score_repository,
        FilesRepository $file_repository,
        UserRepository $user_repository,
        SupportsRepository $support_repository
    ){
        $this->leads_repository = $leads_repository;
        $this->degree_repository = $degree_repository;
        $this->contacts_repository = $contacts_repository;
        $this->family_repository = $family_repository;
        $this->score_repository = $score_repository;
        $this->file_repository = $file_repository;
        $this->user_repository = $user_repository;
        $this->support_repository = $support_repository;
    }
    public function create_users($params){        
        $data_users = null;
        $create = null;
        if(isset($params['email'])) {                        
            $users = User::where('email', $params['email'])->first();            
            if(!isset($users->email)) {
                $data_users = [
                    "status" => User::NOT_ACTIVE,
                    "email" => isset($params["email"]) ? trim($params["email"]) : null,
                    "type"  => User::TYPE_LEADS,
                    "password"   => isset($params["password"]) ? Hash::make(trim($params["password"])) : Str::random(16),
                ];   
            }          
            $create = $this->user_repository->create($data_users);
        }
        return $create;
    }
    public function create($params){
        $result = $this->insert($params);
        return response()->json($result);
    }
    public function action_insert($params){
        $params["password"] = Str::random(16);                                          
        $data_sendmail = [
            "title"         => "Thông tin đăng ký hồ sơ",  
            'subject'       => "Thông tin đăng ký hồ sơ",              
            "full_name"     => isset($params["full_name"]) ? trim($params["full_name"]) : null,
            "email"         => isset($params["email"]) ? trim($params["email"]) : null,
            "phone"         => isset($params["phone"]) ? trim($params["phone"]) : null,               
            "gender"        => $params["gender"] == 1 ? 'Nam' : ($params["gender"] == 0 ? 'Nữ' : 'Khác'),
            "password"      => isset($params["password"]) ?  trim($params["password"]) : Str::random(16),               
            'to'            => $params['email'],
            "date_of_birth" => isset($params["full_date_of_birthname"]) ? trim($params["date_of_birth"]) : null,
        ];            
        $data = [
            "email"      => isset($params["email"]) ? trim($params["email"]) : null,
            "code"       => "TS" . rand(100000, 999999),
            "full_name"  => isset($params["full_name"]) ? trim($params["full_name"]) : null,
            "gender"     => isset($params["gender"]) ? trim($params["gender"]) : null,
            "phone"      => isset($params["phone"]) ? trim($params["phone"]) : null,
            "identification_card"   => trim($params["identification_card"]),                
            "sources_id" => isset($params["sources_id"]) ? trim($params["sources_id"]) : null,
            "marjors_id" => isset($params["marjors_id"]) ? trim($params["marjors_id"]) : null,                
            "created_by" => Auth::user()->id ?? NULL,
            "lst_status_id"  => 1,
            "tags_id"    => 1,                
            "place_of_birth"        => isset($params["place_of_birth"]) ?  trim($params["place_of_birth"]) : null,
            "place_of_wrk_lrn"      => isset($params["place_of_wrk_lrn"]) ? trim($params["place_of_wrk_lrn"]) : null,                
            "date_of_birth"         => isset($params["date_of_birth"]) ? Carbon::createFromFormat('d/m/Y', trim($params["date_of_birth"]))->format('Y-m-d') : null,                
        ];                    
        $leads = $this->leads_repository->create($data);             
        if (isset($leads->id)) {
            $users = $this->create_users($params); 
            if(isset($users->id)) {
                $this->sendmail($data_sendmail);
            }
        }
        return $leads;
    }
    public function insert($params){        
        try {  
            $result = null;                    
            $leads = $this->action_insert($params);           
            if (isset($leads->id) && isset($users->id)) {
                // Gửi thông tin đăng ký                
                $result = [
                    "code"              => 200,
                    "message"           => "Đăng ký hồ sơ thành công! Thông tin đăng ký đã được gửi Email " . trim($params["email"]),
                    "data" => [
                        "id"            => $leads->id,
                        "code"          => $leads->code ?? null,
                        "email"         => $leads->email ?? null,
                        "date_of_birth" => $leads->date_of_birth ?? null,
                        "gender"        => $leads->gender ?? null,
                        "marjors"       => $leads->marjors->name ?? null, 
                    ]
                ];                
            } else {
                $result = [
                    "code" => 422,
                    "message" => "Dữ liệu thêm mới thất bại"
                ];
            }    
            return $result;
        } catch (\Exception $e) {            
            Log::error('Thông báo lỗi: ' . $e->getMessage());
            return [
                "code" => 422,
                "message" => $e->getMessage()
            ];
        }
    }
    public function uAvatar($params, $id){        
        
        try {
            $params['title'] = "Ảnh avatar";            
            $data = [];
            $model = $this->leads_repository->where('id', $id)->first();
            if(!isset($model->id)){
                return response()->json([
                    "code" => 422,
                    "message" => "Không tìm thấy Thí sinh này"
                ]);
            }            
            $url = "/assets/upload/" . $model['code'] . '/';
            // upload nhiều file
            $data = $this->upload_image($params, $url, $id);            
            $model = $this->file_repository->create($data);
            if (isset($model->id)) {
                return [
                    "code"      => 200,
                    "message"   => "Tải avatar thành công",
                    "data"      => [
                        "leads_id" => $model->leads_id,
                        "image_url" => $model->image_url,
                    ]
                ];
            } else {
                return [
                    "code"      => 422,
                    "message"   => "Tải avatar thất bại"
                ];
            }
        } catch (\Exception $e) {            
            Log::error('Thông báo lỗi: ' . $e->getMessage());
            return response()->json([
                "code" => 422,
                "message" => $e->getMessage()
            ]);
        }

    }
    // cập nhật leads và thêm mới thông tin văn bằng
    public function uPersonal($params, $id) {        
        $data_leads = [
            "avatar"        => trim($params["avatar"]),
            "date_of_birth" => Carbon::createFromFormat('d/m/Y', trim($params["date_of_birth"]))->format('Y-m-d'),
            "place_of_birth"=> trim($params["place_of_birth"]),
            "nations_name"  => trim($params["nations_name"]),
            "ethnics_name"  => trim($params["ethnics_name"]),
            "identification_card"       => trim($params["identification_card"]),
            "date_identification_card"  => isset($degree["date_identification_card"]) ? Carbon::createFromFormat('d/m/Y', trim($params["date_identification_card"]) )->format('Y-m-d') : null,
            "place_identification_card" => trim($params["place_identification_card"]),
            "date_of_join_youth_union"  => isset($params["date_of_join_youth_union"]) ? Carbon::createFromFormat('d/m/Y', trim($params["date_of_join_youth_union"]) )->format('Y-m-d') : null,
            "date_of_join_communist_party" => isset($params["date_of_join_communist_party"]) ? Carbon::createFromFormat('d/m/Y',  trim($params["date_of_join_communist_party"]) )->format('Y-m-d') : null,            
            "company_name" => trim($params["company_name"]),
            "company_address" => trim($params["company_address"]),
        ];    
        // Update lại dữ liệu thì sinh đã đăng ký trước        
        $model = $this->leads_repository->updateById($id, $data_leads);       
        
        // Thêm mới bảng văn bằng tốt nghiệp
        $data_degree = [];
       foreach ($params['degree_informations'] as $degree) {
        $data_degree[] = [
            "title"=> $degree['title'] ?? null,
            "leads_id" => $id ?? null,
            "students_id" => $degree['students_id'] ?? null,
            "type_id" => $degree['type_id'] ?? null,
            "year_of_degree" => $degree['year_of_degree'] ?? null,
            "date_of_degree" => isset($degree["date_of_degree"]) ? Carbon::createFromFormat('d/m/Y', trim($degree["date_of_degree"]) )->format('Y-m-d') : null,
            "serial_number_degree" => $degree['serial_number_degree'] ?? null,
            "place_of_degree" => $degree['place_of_degree'] ?? null
        ];
       }
       // Thêm mới văn bằng
        $this->degree_repository->createMultiple($data_degree);
        
        $result = null;
        if($model->id && count($degree) > 0) {
            $result = [
                "code"      => 200,
                "message"   => "Thông tin đã cập nhật thành công",
                "data" => [
                        "id"            => $model->id,
                        "code"          => $model->code,
                        "email"         => $model->email,
                        "date_of_birth" => $model->date_of_birth,
                        "gender"        => $model->date_of_birth,
                        "marjors"       => $model->marjors->name
                    ]
            ];
        } else {
            $result = [
                "code"      => 422,
                "message"   => "Thông tin đã được cập nhật thất bại"
            ];
        }

        return response()->json($result);
    }
   
    public function getParamsContacts($params, $id){
        $data = [];
        $prefix = config('app.data.contact_prefix') ?? ['hktt', 'dcll'];
        if(count($prefix) > 0){
            foreach ($prefix as $value) {                 
                $title = $params['title_' . $value];
                $data[] = [
                    "type" => Contacts::CONTACTS_MAP_ID[$title],
                    "title" => Contacts::CONTACTS_MAP_TEXT[$title],
                    "provinces_name" => $params['provinces_name_'.$value],
                    "districts_name" => $params['districts_name_'.$value],
                    "wards_name" => $params['wards_name_'.$value],
                    "address" => $params['address_'.$value],
                    "leads_id" => $id
                ];
            }             
        }          
        return $data;
    }
    public function contacts($param, $id) {       
        $data = $this->getParamsContacts($param, $id);                                 
        $model = $this->contacts_repository->createMultiple($data);
        if(count($model) > 0) {            
            $data = [
                "code" => 200,
                "message" => "Đăng ký thông tin liên lạc thành công",
                "leads_id" => $id
            ];
        } else {
            $data = [
                "code" => 200,
                "message" => "Đăng ký thông tin liên lạc thất bại"
            ];
        }
        return response()->json($data);
    }
    public function getDataFamily($params, $id){       
        $prefix = config('app.data.family_prefix');        
        $data = [];
        if(isset($prefix) && count($prefix) > 0) {            
            foreach ($prefix as $v) {
                if(isset($params['full_name_' . $v]) && strlen($params['full_name_' . $v]) > 0) {
                    $title = isset($params['title_' . $v]) ?  trim($params['title_' . $v]) : null;
                    $data[] = [
                        "title"     => FamilyInformations::FAMILY_MAP_TEXT[$title],
                        "type"      => FamilyInformations::FAMILY_MAP_ID[$title],
                        "leads_id"  => $id ?? null,
                        "full_name" => isset($params['full_name_' . $v]) ? trim($params['full_name_' . $v]) : null,
                        "phone_number" => isset($params['phone_number_' . $v]) ? trim($params['phone_number_' . $v]) : null,
                        "year_of_birth" => isset($params['year_of_birth_' . $v]) ? trim($params['year_of_birth_' . $v]) : null,
                        "jobs" => isset($params['jobs_' . $v]) ? trim($params['jobs_' . $v]) : null,
                        "edutcation_id" => isset($params['edutcation_id_' . $v]) ? trim($params['edutcation_id_' . $v]) : null
                    ];                
                }
            }            
        }             
        return $data;
    }
    public function family($params, $id) {       
        $data = $this->getDataFamily($params, $id);             
        $model = $this->family_repository->createMultiple($data);        
        if(count($model) > 0) {            
            $data = [
                "code" => 200,
                "message" => "Đăng ký thông tin liên lạc thành công",
                "leads_id" => $id
            ];
        } else {
            $data = [
                "code" => 200,
                "message" => "Đăng ký thông tin liên lạc thất bại"
            ];
        }
        return $data;
    }
    // Thông tin xét tuyển theo bảng điểm
    public function score($params, $id){
        try {
            $leads = $this->leads_repository->where('id', $id)->count();
            if ($leads <= 0) {
                return [
                    "code" => 422,
                    "message" => "Vui lòng chọn thí sinh cần xét tuyển"
                ];
            }
            $params['leads_id'] = $id;
            $params['total_score'] = ($params['score1'] ?? 0) +  ($params['score2'] ?? 0) +  ($params['score3'] ?? 0);
            $params['created_by'] = Auth::user()->id ?? null;
            $model = $this->score_repository->create($params);
            $result = null;
            if (isset($model->id)) {
                $result = [
                    "code" => 200,
                    "message" => "Dữ liệu đã được thêm mới thành công"
                ];
            } else {
                $result = [
                    "code" => 422,
                    "message" => "Dữ liệu thêm mới thất bại"
                ];
            }
            return response()->json($result);
        } catch (\Exception $e) {
            Log::error('Thông báo lỗi: ' . $e->getMessage() . ' tại dòng số: ' . $e->getMessage());
            return $e->getMessage();
        }
    }
    // Xác nhận hồ sơ sẽ lưu vào thư mục tương ứng mới mã hồ sơ code Ts....****
    public function confirm($params, $id){        
        $data = [];
        $model = $this->leads_repository->where('id', $id)->first();
        $url = "/assets/upload/" . $model['code'] . '/';
        // upload nhiều file
        $data = $this->upload_images($params, $url, $id); 
        // ghi vào database theo mã hồ sơ của thí sinh
        $model = $this->file_repository->createMultiple($data);        
        if(count($model) > 0) {
            return [
                "code"      => 200,
                "message"   => "Tải hồ sơ thành công"
            ];
        } else {
            return [
                "code"      => 422,
                "message"   => "Tải hồ sơ thất bại"
            ];
        }
    }
    // Phần này trong CRM
    private function filter($params){
        $model = $this->leads_repository->with([
                'sources','marjors','status','tags','contacts','score','user', 
                "create_by","update_by","delete_by","files","supports","family"
        ]);
        if(isset($params['keyword'])) {
            $model = $model->where('full_name', '%'. $params['keyword'] .'%', 'LIKE');                       
        }
        if(isset($params['sources_id'])) {
            $model = $model->where('sources_id', $params['sources_id']);
        }
        if(isset($params['lst_status_id'])) {
            $model = $model->where('lst_status_id', $params['lst_status_id']);
        }
        if(isset($params['tags_id'])) {
            $model = $model->where('tags_id', $params['tags_id']);
        }
        if(isset($params['marjors_id'])) {
            $model = $model->where('marjors_id', $params['marjors_id']);
        }
        if(isset($params['employees_id'])) {
            $model = $model->where('employees_id', $params['employees_id']);
        }      
        if(isset($params['from_date']) && isset($params['to_date'])) { 
            $from_date =Carbon::createFromFormat('d/m/Y', trim($params["from_date"]))->format('Y-m-d');       
            $to_date = Carbon::createFromFormat('d/m/Y', trim($params["to_date"]))->format('Y-m-d');       
            $model = $model->where('created_at', $from_date , '>=' )
                           ->where('created_at', $to_date , '<=' );
        } 
        return $model->orderBy('id', 'desc');
    }
    // Hiển thị danh sách thí sinh
    public function data($params){   
        try {            
            $record = $params['record'] ?? 15;                
            $model = $this->filter($params);
            $entries = $model->paginate($record);
            foreach ($entries as $entry) {
                $entry['sources'] = $entry->sources ?? null;
                $entry['marjors'] = $entry->marjors ?? null;
                $entry['status'] = $entry->status ?? null;
                $entry['tags'] = $entry->tags ?? null;
                $entry['contacts'] = $entry->contacts ?? null;
                $entry['score'] = $entry->score ?? null;
                $entry['user'] = $entry->user ?? null;
                $entry['create_by'] = $entry->create_by ?? null;
                $entry['update_by'] = $entry->update_by ?? null;
                $entry['delete_by'] = $entry->delete_by ?? null;
                $entry['supports'] = $entry->supports ?? null;
                $entry['files'] = $entry->files ?? null;
                $entry['family'] = $entry->family ?? null;
            }
            return [
                'code' => 200,
                'data' => [                    
                    'entries' => $entries,
                    'paginate' => [
                        'totalRecord' => $entries->total(),
                        'currentPage' => $entries->currentPage(),
                        'lastPage' => $entries->lastPage(),
                    ]
                ]
            ];
        } catch (\Exception $e) {                  
            Log::error('Thông báo lỗi: ' . $e->getMessage());
            return response()->json([
                "code" => 422,
                "message" => $e->getMessage()
            ]);
        }  
    }
    // Chi tiết thí sinh
    public function details($params){   
        try {            
            $model = $this->leads_repository->with([
                'sources','marjors','status','tags','contacts','score','user', 
                "create_by","update_by","delete_by","files","supports","family"
            ])->first();            
            foreach ($model as $entry) {
                $entry['sources'] = $entry->sources ?? null;
                $entry['marjors'] = $entry->marjors ?? null;
                $entry['status'] = $entry->status ?? null;
                $entry['tags'] = $entry->tags ?? null;
                $entry['contacts'] = $entry->contacts ?? null;
                $entry['score'] = $entry->score ?? null;
                $entry['user'] = $entry->user ?? null;
                $entry['create_by'] = $entry->create_by ?? null;
                $entry['update_by'] = $entry->update_by ?? null;
                $entry['delete_by'] = $entry->delete_by ?? null;
                $entry['supports'] = $entry->supports ?? null;
                $entry['files'] = $entry->files ?? null;
                $entry['family'] = $entry->family ?? null;
            }
            return [
                'code' => 200,
                'data' => $model
            ];
        } catch (\Exception $e) {                  
            Log::error('Thông báo lỗi: ' . $e->getMessage());
            return response()->json([
                "code" => 422,
                "message" => $e->getMessage()
            ]);
        }
    }
    // Chỉnh sửa thí sinh
    public function update($params, $id){          
        try {            
            DB::beginTransaction();
            $result = null;        
            $leads_update_status = $this->post_update_leads($params, $id);              
            if($leads_update_status['code'] == 200) {                                
                // Trường hợp email mới có dữ liệu và không trùng với email cũ cho xử sửa đổi trong email
                if(strlen(trim($leads_update_status['new_email'])) > 0 && trim($leads_update_status['new_email']) != trim($leads_update_status['old_email'])) {                     
                    $params['old_email'] = trim($leads_update_status['old_email']);                 
                    $this->post_update_user($params);                    
                }
                // cập nhật thông tin gia đình
                $this->post_update_family($params, $id);                                
                // Cập nhật thông tin liên lạc
                $this->post_update_contacts($params, $id);  
                $result = response() ->json([
                    "code" => 200,
                    "message" => "Cập nhật danh thông tin thí sinh thành công"
                ], 200);
            }
            else {
                $result = response() ->json([
                    "code" => 401,
                    "message" => "Cập nhật danh thông tin thí sinh không thành công"
                ], 401);
            }
            DB::commit();
            return $result;
        } catch (\Exception $e) {                  
            DB::rollBack();
            Log::error('Thông báo lỗi: ' . $e->getMessage());
            return response()->json([
                "code" => 422,
                "message" => $e->getMessage()
            ]);
        }   
    }
    // Update leads   
    private function post_update_leads($params, $id){          
        $data_update_leads = [];
        $old_email = null;
        // Họ và tên
        if(isset($params["full_name"]) && strlen($params["full_name"]) > 0) {            
            $data_update_leads["full_name"] = trim($params["full_name"]);
        }
        // Email
        if(isset($params["email"]) && strlen($params["email"]) > 0) {
            $old_email = $this->leads_repository->where('id', $id)->first()->email;
            if(trim($params["email"]) != trim($old_email)) $data_update_leads["email"] = trim($params["email"]);
        }
        // Giới tính
        if(isset($params["gender"]) && strlen($params["gender"]) > 0) {
            $data_update_leads["gender"] = trim($params["gender"]);
        }        
        // Số điện thoại
        if(isset($params["phone"]) && strlen($params["phone"]) > 0) {
            $data_update_leads["phone"] = trim($params["phone"]);
        }
        // Ngày sinh
        if(isset($params["date_of_birth"]) && strlen($params["date_of_birth"]) > 0) {
            $data_update_leads["date_of_birth"] = Carbon::createFromFormat('d/m/Y', trim($params["date_of_birth"]))->format('Y-m-d');
        }
        // CCCD
        if(isset($params["identification_card"]) && strlen($params["identification_card"]) > 0) {
            $data_update_leads["identification_card"] = trim($params["identification_card"]);
        }
        // Trạng thái
        if(isset($params["lst_status_id"]) && strlen($params["phone"])) {
            $data_update_leads["lst_status_id"] = trim($params["lst_status_id"]);
        }        
        // Nguồn tiếp cận
        if(isset($params["sources_id"]) && strlen($params["sources_id"]) > 0) {
            $data_update_leads["sources_id"] = trim($params["sources_id"]);
        }
        // Nhân viên tư vấn
        if(isset($params["employees_id"]) && strlen($params["employees_id"]) > 0) {
            $data_update_leads["employees_id"] = trim($params["employees_id"]);
        }        
        // Chuyên ngành
        if(isset($params["marjors_id"]) && strlen($params["marjors_id"]) > 0) {
            $data_update_leads["marjors_id"] = trim($params["marjors_id"]);
        }  
        $update = $this->leads_repository->updateById($id, $data_update_leads);        
        $code = false;
        if(isset($update->id)) {
            $code = 200;
        } else {
            $code = 400;
        }
        return [
            "code" => $code ?? 422,
            "old_email" => $old_email ?? null,
            "new_email" => $data_update_leads["email"] ?? null  
        ];
    }
    // Update users
    private function post_update_user($params){        
        $data = [];
        // Họ và tên
        if(isset($params["old_email"]) && strlen($params["old_email"]) > 0 && isset($params["email"]) && strlen($params["email"]) > 0) {            
            $old_email = $params['old_email'];            
            $data["email"] = trim($params["email"]);
            $update = User::where('email', $old_email)->update($data);            
            $result = null;
            if($update > 0) {
                $result = [
                    "code" => 200,
                    "message" => "Cập nhập email thành công"
                ];
            } else {
                $result = [
                    "code" => 422,
                    "message" => "Cập nhập email không thành công"
                ];
            }
        }
        return $result;
    }
    // Update family
    // ------------------------------------------------------------
    private function update_family($data, $id){  
        $dem = 0;              
        foreach ($data as $value) {
            $update = FamilyInformations::where('leads_id', $id)->where('type', $value['type'])->update($value);
            if($update > 1) $dem +=1;
        }        
        if($dem > 0){
            $result[] = [
                "code" => 200,
                "message" => "Cập nhật thông tin gia đình thành công"
            ];
        } else {
            $result[] = [
                "code" => 422,
                "message" => "Cập nhật thông tin gia đình không thành công"
            ];
        }
    }
    public function getFamilyParrams($params, $id){        
        $prefix = config('app.data.family_prefix');             
        $data = [];
        if(isset($prefix) && count($prefix) > 0) {
            foreach ($prefix as $v) {
                if(isset($params['full_name_' . $v]) && strlen($params['full_name_' . $v]) > 0) {
                    $title = isset($params['title_' . $v]) ?  trim($params['title_' . $v]) : null;                            
                    $data[] = [
                        "title"     => FamilyInformations::FAMILY_MAP_TEXT[$title],
                        "type"      => FamilyInformations::FAMILY_MAP_ID[$title],
                        "leads_id"  => $id ?? null,
                        "full_name" => isset($params['full_name_' . $v]) ? trim($params['full_name_' . $v]) : null,
                        "phone_number" => isset($params['phone_number_' . $v]) ? trim($params['phone_number_' . $v]) : null,                        
                    ];
                }
            }
        }                
        return $data;  
    }
    private function post_update_family($params, $id){      
        $data = $this->getFamilyParrams($params, $id);              
        $leads = $this->family_repository->where('leads_id', $id)->count();              
        if($leads <= 0) {
            // Chưa có thì tạo mới
            $result = $this->family($data, $id);                
        } else {            
            // cập nhật            
            $result = $this->update_family($data, $id);
        }
        return $result;
    }
    // ------------------------------------------------------------
    private function post_update_contacts($params, $id){       
        $data = $this->getParamsContacts($params, $id);
        $cContacts = $this->contacts_repository->where('leads_id', $id)->count();       
        if($cContacts <= 0) {            
            $result =  $this->contacts_repository->createMultiple($data);        
        } else {                                        
            $result = $this->update_contacts($data, $id);
        }
        return $result;
    }
    private function update_contacts($data, $id){                     
        $result = [];
        $dem = 0;
        foreach ($data as $value) {        
            $model = Contacts::where('leads_id', $id)->where('type', $value['type'])->update($value);  
            if($model > 0) $dem += 1;
        }   
        if($dem > 0){
            $result[] = [
                "code" => 200,
                "message" => "Cập nhật thông tin liên lạc thành công"
            ];
        } else {
            $result[] = [
                "code" => 422,
                "message" => "Cập nhật thông tin liên lạc không thành công"
            ];
        }             
        return $result;
    }
    public function getFamilyParramsForCreate($params){
        $prefix = config('app.data.family_prefix');             
        $data = [];
        if(isset($prefix) && count($prefix) > 0) {
            foreach ($prefix as $v) {
                if(isset($params['full_name_' . $v]) && strlen($params['full_name_' . $v]) > 0) {
                    $title = isset($params['title_' . $v]) ?  trim($params['title_' . $v]) : null;                            
                    $data[] = [
                        "title"     => FamilyInformations::FAMILY_MAP_TEXT[$title],
                        "type"      => FamilyInformations::FAMILY_MAP_ID[$title],                       
                        "full_name" => isset($params['full_name_' . $v]) ? trim($params['full_name_' . $v]) : null,
                        "phone_number" => isset($params['phone_number_' . $v]) ? trim($params['phone_number_' . $v]) : null,                        
                    ];
                }
            }
        }                    
        return $data;  
    }
    // Xóa bỏ thí sinh tiềm năng
    public function crm_create_lead($params){        
        $leads = $this->action_insert($params);
        if(isset($leads->id)) {
            $this->family($params, $leads->id); 
            $this->contacts($params, $leads->id);            
            $result = [
                    "code"              => 200,
                    "message"           => "Đăng ký hồ sơ thành công! Thông tin đăng ký đã được gửi Email " . trim($params["email"]),
                    "data" => [
                        "id"            => $leads->id,
                        "code"          => $leads->code ?? null,
                        "email"         => $leads->email ?? null,
                        "date_of_birth" => $leads->date_of_birth ?? null,
                        "gender"        => $leads->date_of_birth ?? null,
                        "marjors"       => $leads->marjors->name ?? null, 
                    ]
            ];   
        } else {
            $result = [
                "code" => 422,
                "message" => "Dữ liệu thêm mới thất bại"
            ];
        }      
        return $result;      
    }
    public function update_status_lead($params, $id){        
        try {            
            $data = [
                "lst_status_id" => $params['lst_status_id'] ?? 1,
            ];
            $update = $this->leads_repository->updateById($id, $data);            
            $response = null;
            if(isset($update->id)) {
                $response = [
                    "code"      => 200,
                    "message"   => "Cập nhật trạng thái thành công"
                ];
            } else {
                $response = [
                    "code"      => 401,
                    "message"   => "Cập nhật trạng thái thất bại"
                ];
            }
        } catch (\Exception $e) {
            Log::error('Thông báo lỗi: ' . $e->getMessage());
            return response()->json([
                "code" => 422,
                "message" => $e->getMessage()
            ]);
        }
        return response()->json($response);
    }
    // xóa email tương ứng với leads cần xóa
    public function user_delete($id){
        $user_delete = $this->user_repository->deleteById($id);
        // Sau này phát sinh bảng liên quan thì bổ sung tại đây
        return [            
            "user_delete"  => $user_delete,         
        ];
    }
    public function delete_relationship_lead($id){
        // Xóa dữ liệu file
        $file_delete = $this->file_repository->where('leads_id', $id)->delete();               
        // Xóa dữ liệu yêu cầu hỗ trợ
        $support_delete = $this->support_repository->where('leads_id', $id)->delete();
        // Xóa dữ liệu thông tin liên lạc
        $contacts_delete = $this->contacts_repository->where('leads_id', $id)->delete();
        // Xóa dữ liệu thông tin gia đình
        $family_delete = $this->family_repository->where('leads_id', $id)->delete();
        // Xóa dữ liệu thông tin liên lạc
        $score_delete = $this->score_repository->where('leads_id', $id)->delete();
        // Xóa Email
        // Xóa tài khoản đăng nhập
        $email = $this->leads_repository->where('id', $id)->first()->email;
        $users_id = $this->user_repository->where('email', $email)->first()->id;        
        $user_delete = $this->user_delete($users_id);                    
        // Sau này phát sinh bảng liên quan thì bổ sung tại đây
        return [
            "file_delete"       => $file_delete,
            "support_delete"    => $support_delete,
            "contacts_delete"   => $contacts_delete,
            "family_delete"     => $family_delete,
            "score_delete"      => $score_delete,
            "user_delete"      => $user_delete
        ];
    }
    // Xóa dữ liệu  bảng thí sinh
    public function delete($id){
        try {
            DB::beginTransaction();
            // Chỗ xóa này sau này cần thêm bảng history để lưu lại
            // Gọi hàm xóa các bảng liên quan
            $this->delete_relationship_lead($id);    
            $lead_delete = $this->leads_repository->deleteById($id);
            if($lead_delete > 0) {
                $result = [
                    "code"      => 200,
                    "message"   => "Xóa thí sinh thành công"
                ];
            } else {
                $result = [
                    "code"      => 422,
                    "message"   => "Xóa thí sinh không thành công"
                ];
            }
            DB::commit();
            return response()->json($result);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Thông báo lỗi: ' . $e->getMessage());
            return response()->json([
                "code" => 422,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function export($params){        
        $query = $this->filter($params);
        $data = $query->get();
        return Excel::download(new LeadsExport($data), 'ExportExcel.xlsx');
    }
    public function import($params){       
        try {     
            if(!isset($params['file'])){
                return [
                    "code" => 422,
                    "message" => "Vui lòng chọn file import"
                ];
            }
            Excel::import(new LeadsImports, $params['file']);                           
            return response()->json([
                "code" => 200,
                "message" => "Import Excel thành công"
            ]);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {                        
            // Log::error('Thông báo lỗi: ' . $e->getMessage());
            // return [
            //     "code" => 422,
            //     "message" => $e->getMessage()
            // ];

            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }

            return [
                "code" => 422,
                "message" => $failures
            ];

        }
    }

}




