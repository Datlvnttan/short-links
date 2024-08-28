<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Repositories\Interface\UserRepositoryInterface;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public static function getPaginated(UserRepositoryInterface $userRepo, ?int $perpage)
    {
        $data = $userRepo->getPaginated($perpage);
        return ResponseJson::success(data:$data);
    }
    // public static function login($usertRepo,$fieldvalue,$password)
    // {    
        
    //         //$user = $usertRepo->findByField($fieldvalue);
    //         $field = $usertRepo->getField($fieldvalue);
    //         try {
    //             if (!$token = JWTAuth::attempt([$field => $fieldvalue, 'password' => $password])) {
    //                 return response()->json(['error' => 'Invalid credentials'], 401);
    //             }
    //         } catch (JWTException $e) {
    //             return response()->json(['error' => 'Could not create token'], 500);
    //         }
    //         return ResponseJson::success(data:$token);
    //         // $sucess = false;
    //         // $statusCode = 401;
    //         // if($user){                
    //         //     if(strcmp($user->password,$password)==0){
    //         //         if($user->status == true)
    //         //         {
    //         //             Auth::login($user);
    //         //             $sucess = true;
    //         //             $msg = "Logged in successfully";                    
    //         //             $statusCode = 200;
    //         //         }
    //         //         else
    //         //             $msg = "Account locked"; 
    //         //     }                
    //         //     else
    //         //         $msg = "Incorrect password";                                                        
    //         // }
    //         // else
    //         //     $msg = "Account does not exist";                              
    //         // return ResponseJson::successSetup(success:$sucess,msg:$msg,statusCode:$statusCode);          
    // }
    // public static function logout()
    // {
    //     Auth::logout();        
    //     return ResponseJson::success("Log out successfully");          
    // }   
    public static function update($userRepo,$data,$user)
    {
        if(!isset($data["username"])||trim($data["username"])=="")
            return ResponseJson::status(0,"Username cannot be blank",statusCode:422);
        if(!isset($data["email"])||trim($data["email"])=="")
            return ResponseJson::status(-1,"Email cannot be blank",statusCode:422);
        if(!isset($data["full_name"])||trim($data["full_name"])=="")
            return ResponseJson::status(-3,"Full name cannot be blank",statusCode:422);
        $userFind = $userRepo->findBy("username",$data["username"])->first();
        if(isset($userFind) && $userFind->id != $user->id){
            return ResponseJson::status(0,"Username is already taken",statusCode:422);
        }
        $userFind = $userRepo->findBy("email",$data["email"])->first();
        if(isset($userFind))
        {
            if($userFind->id != $user->id)
                return ResponseJson::status(-1,"New email already exists",statusCode:422);            
        }            
        if($data["email"] != $user->email)
        {
            $data["status"]=false;
            $user->email = $data["email"];
            MailService::SendVerifyEmail($user); 
        }
        if(isset($data["phone_number"]))
        {
            $userFind = $userRepo->findBy("phone_number",$data["phone_number"])->first();
            if(isset($userFind) && $userFind->id != $user->id)
                return ResponseJson::status(-2,"Phone number is already taken",statusCode:422);
        }
        if($userRepo->update($user->id,$data) == false)
            return ResponseJson::failed("Update failed");
        return ResponseJson::success("Update successfully");
    } 
    public static function updatePassword($userRepo,$data,$user)
    {
        if($userRepo->checkPassword($user->id,$data["old_password"]))            
        {            
            if($userRepo->update($user->id,["password"=>$data["new_password"]])==false)
                return ResponseJson::failed("Update failed");
            return ResponseJson::success("Update successfully");
        }
        return ResponseJson::failed("Incorrect password");
    }
}

