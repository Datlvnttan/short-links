<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\RespositoryControllers\ShortUrlRepositoryController;
use App\Http\Controllers\RespositoryControllers\UserRepositoryController;
use App\Repositories\Interface\ShortUrlRepositoryInterface;
use App\Services\ShortLinkService;
use Illuminate\Http\Request;

class ShortLinkApiController extends ShortUrlRepositoryController
{
    protected $userRepo;
    public function __construct(ShortUrlRepositoryInterface $shortUrlRepo, UserRepositoryController $userRepo)
    {
        parent::__construct($shortUrlRepo);
        $this->userRepo = $userRepo;
    }


    public function parse(Request $request)
    {
        return Call::TryCatchResponseJson(function() use ($request){
            return ShortLinkService::parse($this->shortUrlRepo,$this->userRepo,$request->all());
        });
    }   
    public function getMaximumTermExpired()
    {
        return Call::TryCatchResponseJson(function(){                        
            return ResponseJson::success(data:ShortLinkService::getMaximumTermExpired());
        });
    }
}
