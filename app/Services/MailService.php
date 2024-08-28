<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Jobs\AutomaticMassEmailJob;
use App\Jobs\SendVerificaEmailJob;
use App\Jobs\SendVerifyEmailJob;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MailService
{    
    public static function SendVerifyEmail($user)
    {               
        SendVerifyEmailJob::dispatch($user);       
        return true;
    }

    public static function SendVerifyEmailResponseJson($user)
    {               
        MailService::SendVerifyEmail($user);       
        return ResponseJson::success("Verification email has been sent again, please check your email");
    }

    //class MailService
    public static function verificaEmail($userRepo,$id, string $token)
    {
        $user = $userRepo->findBy("id",$id)->first();        
        if($user->token == $token)
        {
            $user->status = true;
            $user->save();
            return ResponseJson::success("Email verification successful");
        }               
        return ResponseJson::failed("Email verification failed"); 
    }

    //class MailService
    // public static function sendAllEmails()
    // {
    //     foreach (Users::all() as $user) {            
    //         AutomaticMassEmailJob::dispatch($user,"This is automation email","emails.auto_test",null);                    
    //     }
    // }
    // public static function sendHappyBirthdayEmail()
    // {
        
    //     Log::info(Users::all()->count());
    //     foreach (Users::all() as $user) { 
    //         if($user->isBirthday())                              
    //         AutomaticMassEmailJob::dispatch($user,"Happy BirthDay","emails.happy_birthday",$user);                    
    //     }
    // }

}


