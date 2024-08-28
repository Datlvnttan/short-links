<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Models\Premium;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Str;

class AuthService
{
    public static function login($usertRepo,$fieldvalue,$password)
    {    
        $field = $usertRepo->getField($fieldvalue);
        try {
            $user = [$field => $fieldvalue, 'password' => $password];
            $token = auth()->attempt($user);
            // if($token!=false)
            // {
            //     Auth::login($usertRepo->findBy($field,$fieldvalue)->first());
            // }
            return $token;
        } catch (JWTException $e) {
            return ResponseJson::error($e->getMessage(), 500);
        }            
    }
    public static function register($usertRepo,$full_name, $email, $password)
    {
                                                                                
        if($usertRepo->findBy("email",$email)->first())
            return ResponseJson::errors([
                "email"=> ["Email already exists!"],
            ],statusCode:422);        
        $token = strtoupper(Str::random(20));
        $username = "";
        $countUser = $usertRepo->all()->count();
        do
        {
            $username = "user0".strval(++$countUser);
        }while($usertRepo->findBy("username",$username)->first()!=null);
        $role_id = Role::orderBy('priority', 'desc')->first()->id;
        $premium_id = Premium::where("level",1)->first()->id;
        $user = [
            "username"=>$username,
            "full_name"=>$full_name,            
            "email"=>$email,
            "password"=>$password,             
            "token"=>$token,
            "role_id"=>$role_id,
            'premium_id'=>$premium_id,
            'premium_register_date'=>Carbon::now(),
            "status"=>false
        ];
        $usertRepo->create($user);
        MailService::SendVerifyEmail($usertRepo->findBy("username",$username)->first());              
        return ResponseJson::success(msg:"Account successfully created. Please verify your email to complete the registration process");
    }
    public static function logout()
    {
        //Auth::logout();        
        return ResponseJson::success("Log out successfully");          
    }

}

