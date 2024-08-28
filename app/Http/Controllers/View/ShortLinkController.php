<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\RespositoryControllers\ShortUrlRepositoryController;
use App\Services\ShortLinkService;
use Illuminate\Http\Request;

class ShortLinkController extends ShortUrlRepositoryController
{   
    public function redirect($shortened_link, Request $request)
    {
        $link = ShortLinkService::getOriginalLink($this->shortUrlRepo, $shortened_link,$request->password);   
        switch ($link) {
            case -6:
                return view("error.reached_visit_limit");   
            case -5:
                return view("error.shortlink_dont_exist");                 
            case -4:
                return view("error.link_has_expired"); 
            case -3:            
                return view("home.shortlink_enter_password")->with("error","Incorrect password"); 
            case -2:
                return view("home.shortlink_enter_password"); 
            case -1:
                return view("error.shortlink_not_yet_ready"); 
            default:
                return redirect()->away($link);                
        }              
                        
    }    
}
