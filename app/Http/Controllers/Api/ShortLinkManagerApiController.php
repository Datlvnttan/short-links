<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RespositoryControllers\ShortUrlRepositoryController;
use App\Services\ShortLinkService;
use Illuminate\Http\Request;

class ShortLinkManagerApiController extends ShortUrlRepositoryController
{
    public function index(Request $request)
    {
        return Call::TryCatchResponseJson(function() use($request){
            return ShortLinkService::get($this->shortUrlRepo,$request->status??0,$request->perpage);
        });
    }
    public function update(Request $request, string $id)
    {
        return Call::TryCatchResponseJson(function() use ($request,$id){
            return ShortLinkService::update($this->shortUrlRepo,$id,$request->all(),true);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Call::TryCatchResponseJson(function() use ($id){
            return ShortLinkService::deleteWhere($this->shortUrlRepo,$id,true);
        });
    }
}
