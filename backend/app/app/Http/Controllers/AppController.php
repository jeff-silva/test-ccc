<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function load(Request $request)
    {
        $token = $request->bearerToken();
        $user = auth()->guard('sanctum')->user();
        return compact(['user']);
    }
}
