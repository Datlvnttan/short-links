<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PremiumFeatureController extends Controller
{
    public function index()
    {
        return view("manager.premium_feature.index");
    }
}
