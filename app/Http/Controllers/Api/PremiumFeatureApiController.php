<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\FeatureRepositoryInterface;
use App\Repositories\Interface\PremiumFeatureRepositoryInterface;
use App\Repositories\Interface\PremiumRepositoryInterface;
use App\Services\PremiumFeatureService;
use Illuminate\Http\Request;

class PremiumFeatureApiController extends Controller
{
    protected $premiumFeatureService;
    public function __construct(PremiumFeatureRepositoryInterface $premiumFeatureRepo , PremiumRepositoryInterface $premiumRepo, FeatureRepositoryInterface $featureRepo)
    {
        $this->premiumFeatureService = new PremiumFeatureService($premiumFeatureRepo,$premiumRepo,$featureRepo);
    }
    public function getByPremium(Request $request)
    {
        return Call::TryCatchResponseJson(function() use ($request) {
            return $this->premiumFeatureService->getDataByPremium($request->premiumid);
        });
    }
    public function updateStatus(Request $request)
    {
        return Call::TryCatchResponseJson(function() use ($request) {
            return $this->premiumFeatureService->updateOrCreate($request->premiumid,$request->featureid, $request->status=="true");
        });
    }
    public function createOrDelete(Request $request)
    {                                
        return Call::TryCatchResponseJson(function() use ($request) {
            return $this->premiumFeatureService->createOrDelete($request->premiumid,$request->featureid, $request->create=="true",$request->hold=="true");
        });
    }
}
