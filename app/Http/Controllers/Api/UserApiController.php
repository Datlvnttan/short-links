<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RespositoryControllers\UserRepositoryController;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApiController extends UserRepositoryController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
        return UserService::getPaginated($this->userRepo,$request->perpage);
        });
    }
    public function infomation()
    {
        return Call::TryCatchResponseJson(function(){
            return ResponseJson::success(data:Auth::user());
        });
    }
    public function changePassword(Request $request)
    {
        return Call::TryCatchResponseJson(function() use($request){
            $user = Auth::user();
            return UserService::updatePassword($this->userRepo,$request->all(), $user);
        });
    }
    

    // public function registerPremium(Request $request)
    // {
    //     return Call::TryCatchResponseJson(function() use ($request) {
    //         return 1;
    //     });
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            $user = Auth::user();
            return UserService::update($this->userRepo,$request->all(), $user);
        });        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
