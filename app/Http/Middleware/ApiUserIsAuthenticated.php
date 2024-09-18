<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiUserIsAuthenticated
{    
    public function handle(Request $request, Closure $next): Response
    {          
        if (!Auth::check() && (!isset(Auth::user()->types) || Auth::user()->types == User::TYPE_EMPLOYEES) ) {                   
            return response() -> json([
                "code" => 400,
                "message" => "Vui lòng đăng nhập hệ thống"
            ]);
        }        
        return $next($request);
    }
}
