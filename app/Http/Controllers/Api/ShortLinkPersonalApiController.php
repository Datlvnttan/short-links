<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RespositoryControllers\ShortUrlRepositoryController;
use App\Services\ShortLinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortLinkPersonalApiController extends ShortUrlRepositoryController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Call::TryCatchResponseJson(function() use($request){
            return ShortLinkService::findByUserId($this->shortUrlRepo,Auth::user()->id,$request->status??0,$request->perpage);
        });
    }

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
    public function update(Request $request, string $id)
    {
        return Call::TryCatchResponseJson(function() use ($request,$id){
            return ShortLinkService::update($this->shortUrlRepo,$id,$request->all());
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Call::TryCatchResponseJson(function() use ($id){
            return ShortLinkService::deleteWhere($this->shortUrlRepo,$id,Auth::user()->id);
        });
    }
}
