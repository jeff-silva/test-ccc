<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppUser;
use App\Http\Requests\AuthRegisterRequest;

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

    public function register(AuthRegisterRequest $request)
    {
        $entity = AppUser::create($request->validated());
        return compact(['entity']);
    }

    public function password()
    {
        return ['password'];
    }
}
