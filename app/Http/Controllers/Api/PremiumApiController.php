<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RespositoryControllers\PremiumRepositoryController;
use App\Http\Requests\PremiumRequest;
use App\Repositories\Interface\PremiumFeatureRepositoryInterface;
use App\Repositories\Interface\PremiumRepositoryInterface;
use App\Services\PremiumService;
use Illuminate\Http\Request;

class PremiumApiController extends PremiumRepositoryController
{
    protected $premiumService;
    public function __construct(PremiumRepositoryInterface $premiumRepo, PremiumFeatureRepositoryInterface $premiumFeatureRepo)
    {
        parent::__construct($premiumRepo);
        $this->premiumService = new PremiumService($premiumRepo,$premiumFeatureRepo);
    }
    public function index(Request $request)
    {
        return Call::TryCatchResponseJson(function() use ($request) {
            return $this->premiumService->get();
        });
    }  
    public function getLevel()
    {
        return Call::TryCatchResponseJson(function(){
            return $this->premiumService->getLevel();
        });
    }
    public function store(PremiumRequest $request)
    {          
        return Call::TryCatchResponseJson(function() use ($request){
            return $this->premiumService->create($request->all());           
        });        
    }
    public function show(int $id)
    {
        return Call::TryCatchResponseJson(function() use ($id) {
            return $this->premiumService->show($id);
        });
    }
    public function update(int $id, PremiumRequest $request)
    {
        return Call::TryCatchResponseJson(function() use ($id,$request) {
            return $this->premiumService->update($id,$request->all());
        });
    }
    public function destroy(int $id,Request $request)
    {        
        return Call::TryCatchResponseJson(function() use ($id,$request) {
            return $this->premiumService->destroy($id,$request->password);
        });
    }
}
