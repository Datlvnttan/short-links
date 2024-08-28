<?php
namespace App\Repositories\Repository;

use App\Repositories\EloquentRepository;
use App\Repositories\Interface\FeatureRepositoryInterface;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;

class FeatureRepository extends EloquentRepository implements FeatureRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Feature::class;
    }    
    public function getDataByPremiumLevel(int $level)
    {
        return $this->model::distinct()->select('p.level', 'feature_name', 'feature_title', 'attribute')
                ->join("premium_features as pf","pf.feature_id","=","features.id")
                ->join("premiums as p","pf.premium_id","=","p.id")                
                ->where("p.level","<",$level)                                    
                ->orderBy("level","desc")
                ->get();
    }
    public function getDataByFollowPremium(int $level)
    {
        return $this->model::select('p.level','features.id', 'feature_name', 'feature_title', 'attribute')
                            ->leftJoin('premium_features as pf', 'pf.feature_id', '=', 'features.id')
                            ->leftJoin('premiums as p', function ($join) use($level) {
                                $join->on('p.id', '=', 'pf.premium_id')
                                    ->where('p.level', '<', $level);
                            })
                            ->orderBy('p.level', 'desc')
                            ->distinct()
                            ->get();
    }
    // public function getDataByFollowPremiumId(int $id, $level)
    // {
    //     return $this->model::select('p.level','p.id as premium_id','p.premium_name','features.id as feature_id', 'feature_name', 'feature_title', 'attribute',"pf.updated_at")                            
    //                         ->leftJoin('premium_features as pf', 'pf.feature_id', '=', 'features.id')
    //                         ->leftJoin('premiums as p', function ($join) use($id,$level) {
    //                             return $join->on('p.id', '=', 'pf.premium_id')                                    
    //                                 ->where(function ($query) use($id,$level){
    //                                     $query->where('p.id', '=', $id)
    //                                         ->orWhere('p.level', '<', $level);
    //                                 });                                   
    //                         })
    //                         ->orderByRaw('ISNULL(p.level), p.level ASC')
    //                         ->distinct("feature_id")
    //                         ->get();
    // }

}
