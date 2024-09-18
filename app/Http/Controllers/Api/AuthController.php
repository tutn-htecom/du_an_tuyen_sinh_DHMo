<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Authentication\AuthInterface;
class AuthController extends Controller
{    
    protected $authInterface;
    public function __construct(AuthInterface $authInterface)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->authInterface = $authInterface;    
    }
    public function login(LoginRequest $request){      
        $params = $request->all();               
        return $this->authInterface->login($params);
    }
    public function register(RegisterRequest $request){       
       $params = $request->all();       
       return $this->authInterface->register($params);
    }
    public function logout() {                  
        return $this->authInterface->logout();
    }
    public function userProfile() {
        return $this->authInterface->userProfile();
    }
    public function changePassWord(ChangePasswordRequest $request) {
        $params = $request->all();               
        return $this->authInterface->changePassWord($params);
    }
    public function refresh(){
        return $this->authInterface->refresh();        
    }
}
