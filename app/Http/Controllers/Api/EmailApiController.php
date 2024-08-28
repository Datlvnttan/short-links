<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RespositoryControllers\UserRepositoryController;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailApiController extends UserRepositoryController
{
    public function reSendVerifyEmail()
    {
        return Call::TryCatchResponseJson(function() {
            $user = Auth::user();              
            return MailService::SendVerifyEmailResponseJson($user);
        });        
    }   
    public function verifyEmail($id, string $token)
    {
        return Call::TryCatchResponseJson(function() use ($id, $token) {
            return MailService::verificaEmail($this->userRepo,$id,$token);
        });
    }
}
