<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return ['login', rand(0, 999)];
    }

    public function logout()
    {
        return ['logout'];
    }

    public function register()
    {
        return ['register'];
    }

    public function password()
    {
        return ['password'];
    }
}
