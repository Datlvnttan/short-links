<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\FeatureRepositoryInterface;
use App\Repositories\Interface\PremiumRepositoryInterface;
use App\Services\FeatureService;
use Illuminate\Http\Request;

class FeatureApiController extends Controller
{
    protected $featureService;
    public function __construct(FeatureRepositoryInterface $featureRepo,PremiumRepositoryInterface $premiumRepo)
    {
        $this->featureService = new FeatureService($featureRepo,$premiumRepo);
    }
    public function getDataByPremiumLevel(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            return $this->featureService->getDataByPremiumLevel($request->level);
        });
    }
    public function getDataByFollowPremium(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            return $this->featureService->getDataByFollowPremium($request->level);
        });
    }
    public function getDataByFollowPremiumId(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            return $this->featureService->getDataByFollowPremiumIdResponseJson($request->id);
        });
    }
    
}
