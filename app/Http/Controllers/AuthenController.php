<?php

namespace App\Http\Controllers;


class AuthenController extends Controller
{
    public function __construct()
    {        
        $this->middleware('auth:api', ['except' => ['login']]);
    }
}
