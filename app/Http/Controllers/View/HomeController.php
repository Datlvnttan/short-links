<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function index()
    {
        // phpinfo();
        return view("home.index");
    }
    public function run()
    {
        if(config("app.run")==false) 
        {            
            Artisan::call('migrate');
            Artisan::call('db:seed',[
            '--class'=>'DatabaseSeeder'
            ]);
            Artisan::call('queue:listen');            
            config()->set('app.run',true);
        }
    }
}
