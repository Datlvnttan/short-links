<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Repositories\Interface\FeatureRepositoryInterface;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\PremiumRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;
use Carbon\Carbon;

class  FeatureService
{
    protected $featureRepo,$premiumRepo;
    public function __construct(mixed $featureRepo = null,PremiumRepositoryInterface $premiumRepo)
    {
        $this->featureRepo = $featureRepo;
        $this->premiumRepo = $premiumRepo;
    }    
    public function getDataByPremiumLevel(int $level)
    {
        $data = $this->featureRepo->getDataByPremiumLevel($level);
        return ResponseJson::success(data: $data);
    }    
    public function getDataByFollowPremium(int $level)
    {
        $data = $this->featureRepo->getDataByFollowPremium($level);
        return ResponseJson::success(data: $data);
    } 
    public function getDataByFollowPremiumId(int $id)
    {
        $premium = $this->premiumRepo->find($id);
        if(isset($premium))
        {
            $data = $this->premiumRepo->getDataFeatureWithSmallerLevels($id,$premium->level);
            $i = count($data)-1;            
            $array = array();
            while($i>=0)
            {
                $premiumRepo = $data[$i];
                while($i>0 && $data[$i]["feature_id"] == $data[$i-1]["feature_id"])
                {
                    $i--;
                    if($data[$i]->premium_name != null)
                        $premiumRepo = $data[$i];                    
                }
                $i--;
                $array[] = $premiumRepo;
            }            
            return $array;
        }
        return false;
    }

    public function getDataByFollowPremiumIdResponseJson(int $id)
    {
        $data = $this->getDataByFollowPremiumId($id);
        if($data == false)
            return ResponseJson::failed("Premium does not exist");                   
        return ResponseJson::success(data:$data);                
    }
    

}

