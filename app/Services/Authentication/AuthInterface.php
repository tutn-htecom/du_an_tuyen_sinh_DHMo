<?php

namespace App\Services\Authentication;

interface AuthInterface
{       
    public function login($params);
    public function register($params);
    public function logout();
    public function refresh();
    public function userProfile();
    public function changePassWord($params);
    public function active($params);
}
