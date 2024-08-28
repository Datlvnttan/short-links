<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Repositories\Interface\FeatureRepositoryInterface;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\PremiumFeatureRepositoryInterface;
use App\Repositories\Interface\PremiumRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;
use App\Repositories\Interface\ShortUrlRepositoryInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class  PremiumFeatureService
{    
    protected $premiumFeatureRepo ,$premiumRepo, $featureRepo;
    public function __construct(PremiumFeatureRepositoryInterface $premiumFeatureRepo, PremiumRepositoryInterface $premiumRepo, FeatureRepositoryInterface $featureRepo)
    {
        $this->premiumFeatureRepo = $premiumFeatureRepo;
        $this->premiumRepo = $premiumRepo;
        $this->featureRepo = $featureRepo;
    }    
    public function getDataByPremium(string $premium_id)
    {
        $data = $this->premiumFeatureRepo->getDataByPremium($premium_id);
        return ResponseJson::success(data: $data);
    }    
    public function updateOrCreate(int $premiumid,int $featureid, bool $status)
    {
        $premium = $this->premiumRepo->find($premiumid);
        if(!isset($premium))
            return ResponseJson::failed("Premium does not exist");
        $feature = $this->featureRepo->find($featureid);
        if(!isset($feature))
            return ResponseJson::failed("Feature does not exist");
        if($data = $this->premiumFeatureRepo->updateOrCreate($premiumid,$featureid,$status)>0)
            return ResponseJson::success(data: $data);
        return ResponseJson::failed("Update failed",422);
    }
    public function createOrDelete(int $premiumid,int $featureid, bool $create, ?bool $hold = false)
    {
        $premium = $this->premiumRepo->find($premiumid);
        if(!isset($premium))
            return ResponseJson::failed("Premium does not exist");
        $feature = $this->featureRepo->find($featureid);
        if(!isset($feature))
            return ResponseJson::failed("Feature does not exist");
        $premiumFeature = $this->premiumFeatureRepo->join('features as f', 'premium_features.feature_id', '=', 'f.id')
                            ->join('premiums as p', 'premium_features.premium_id', '=', 'p.id')
                            ->where('premium_id', '!=', $premiumid)
                            ->where('f.id', $featureid)
                            ->where('p.level',"<", $premium->level)
                            ->first();                            
        if(!isset($premiumFeature))
        {                
            if($this->premiumFeatureRepo->createOrDelete($premium,$featureid,$create,$hold)>0)
                return ResponseJson::success();
            return ResponseJson::failed("Update failed",422);
        } 
        return ResponseJson::failed("Features of lower premium plans cannot be set up through higher level plans");       
    }
}

