<?php

namespace App\Services\Authentication;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthServices implements AuthInterface
{
    
    protected $user_repository;
    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;   
    }
    public function login($params){        
        if (! $token = auth()->attempt($params)) {            
            return response()->json(['code' => 401, 'message' => 'Tài khoản hoặc mật khẩu chưa đúng' ]);
        } 
        // Kiểm tra trạng thái đăng nhập
        $user = $this->user_repository->where('email', $params['email'])->first();
        // Kiểm tra tài khoản đã được kích hoạt chưa
        if($user->status == User::NOT_ACTIVE) {
            return response()->json(['code' => 422, 'message' => 'Tài khoản chưa được kích hoạt!' ]);
        } 
        // Kiểm tra Tài khoản nhân viên hay không
        if($user->types != User::TYPE_EMPLOYEES) {
            return response()->json(['code' => 422, 'message' => 'Truy cập thất bại! Tài khoản của bạn không có quyền truy cập' ]);
        }

        $data = [
            "code" =>  200,
            "message" => "Đăng nhập thành công",
            "data" => $this->createNewToken($token)            
        ];        
        return response()->json($data);
    }
    public function register($params){
        $params['types'] = User::TYPE_EMPLOYEES;        
        $model = $this->user_repository->create($params);        
        if($model->id) return response()->json(["code" => 200,"message" => "Đăng ký tài khoản thành công" ], 200);
        else return response()->json([ "code" => 422,"message" => "Đăng ký tài khoản không thành công"], 422);            
    }
    public function logout(){
        auth()->logout();
        return response()->json([
            "code" => 200,
            'message' => 'Tài khoản đã đăng xuất thành công'
        ]);
    }
    public function refresh(){
        return $this->createNewToken(auth()->refresh());
    }
    public function userProfile(){
        return response()->json(auth()->user());
    }
    public function changePassWord($params){
        if(isset($params['old_password']) && isset($params['new_password']) && trim($params['old_password']) === trim($params['new_password'])) {
            return [
                "code" => 422,
                "message" => "Mật khẩu mới không được trùng với mật khẩu cũ"
            ];
        }   
        $data = [
            'password' => Hash::make(trim($params['new_password']))            
        ];  
        $userId = auth()->user()->id;
        $user = $this->user_repository->updateById($userId, $data);
        return response()->json([
            "code" => 201,
            'message' => 'Người dùng đã thay đổi mật khẩu thành công',
            'user' => $user->toArray(),
        ], 201);
    }

    // Bổ sung thêm hàm
    protected function createNewToken($token){
        
        $data = [                        
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 3600000, // 1 ngày
            'user' => auth()->user()
        ];
        return  $data;        
    }
}
