<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function load(Request $request)
    {
        $user = $request->user();
        return compact(['user']);
    }
}
