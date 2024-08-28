<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShortLinkPersonalController extends Controller
{
    public function index()
    {
        return view("personal.links.index");
    }
}
