<?php

namespace App\Services\Employees;

use App\Models\User;
use Illuminate\Support\Str;
use App\Repositories\EmployeesRepository;
use App\Repositories\UserRepository;
use App\Traits\General;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class EmployeesServices implements EmployeesInterface
{    
    use General;
    protected $emplyee_repository;
    protected $user_repository;
    public function __construct(EmployeesRepository $emplyee_repository, UserRepository $user_repository) {
        $this->emplyee_repository = $emplyee_repository;   
        $this->user_repository = $user_repository;
    }
    public function index($params) {
     
    }
    public function details($id) {

    }
    public function create($params) {             
        try {
            $password = $params["password"] = Str::random(16);
            $params['code'] = "NV"  .rand(1,999999);                
            $params['date_of_birth'] = Carbon::createFromFormat('d/m/Y', trim($params["date_of_birth"]))->format('Y-m-d');            
            $employees = $this->emplyee_repository->create($params);
           
            // Thêm mới bảng users            
            $data_users = [
                "types"      => User::TYPE_EMPLOYEES,
                "email"     => $params["email"],
                "password"  => Hash::make($password)
            ];
            $users = $this->user_repository->create($data_users);
            if(isset($employees->id) && isset($users->id)) {                
                $data_sendmail = [
                    "title"         => "Thông tin đăng ký hồ sơ",  
                    'subject'       => "Thông tin đăng ký hồ sơ",              
                    "full_name"     => trim($params["name"]),
                    "email"         => trim($params["email"]),
                    "phone"         => trim($params["phone"]),                               
                    "password"      => trim($params["password"]),               
                    'to'            => $params['email'],
                    "date_of_birth" => trim($params["date_of_birth"]),
                ];   
                $this->sendmail($data_sendmail);
                return response()->json([
                    "code"      => 200,
                    "message"   => "Thêm mới thành công! Thông tin tài khoản đã được gửi về mail " . $params['email'],
                    "data"      => $employees
                ]); 
            } else {
                return response()->json([
                    "code"      => 422,
                    "message"   => "Thêm mới yêu cầu hỗ trợ không thành công",                    
                ]); 
            }    
            
                     
        } catch (\Exception $e) {
            Log::error('Thông báo lỗi: ' . $e->getMessage() . ' tại dòng số: ' . $e->getMessage());
            return response()->json([
                "code" => 422,
                "message" => $e->getMessage()
            ]); 
       }
    }    
  
    public function update($params, $id) {

    }
    public function delete($id) {

    }
}
