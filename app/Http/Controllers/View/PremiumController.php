<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
    public function register()
    {
        return view("premium.register");
    }
    public function index()
    {
        return view("manager.premium.index");
    }
    public function create()
    {
        return view("manager.premium.create");
    }
    public function edit(int $id)
    {
        return view("manager.premium.edit")->with("id",$id);
    }
}
