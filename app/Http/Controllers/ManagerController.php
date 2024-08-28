<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function index()
    {
        $tatolClicks = DB::table("short_url")->sum("total_visits");
        return view("manager.dashboard")->with("tatol_clicks", $tatolClicks);
    }
}
