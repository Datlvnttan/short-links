<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Jobs\SendVerificaEmailJob;
use App\Models\Users;
use App\Services\MailService;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    
    public function verifyEmail($id, string $token)
    {        
        return view("auth.verify_email",[
            "id"=>$id,
            "token"=>$token
        ]); 
    }
    
    // public function sendAllEmail()
    // {
    //     MailService::sendAllEmails();
    //     return redirect()->route("managerUsers",["sendEmail"=>true]);
    // }
}


