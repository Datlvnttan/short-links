<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShortLinkManagerController extends Controller
{
    public function index()
    {
        return  view("manager.links.index");
    }
}
