<?php
namespace App\Repositories\Repository;

use App\Models\Premium;
use App\Repositories\EloquentRepository;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\PremiumFeatureRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PremiumFeatureRepository extends EloquentRepository implements PremiumFeatureRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\PremiumFeature::class;
    }    
    public function getDataByPremium($premium_id)
    {
        return $this->model::select(
            "f.id",
            "f.feature_name",
            'f.feature_title',
            'f.attribute',            
            DB::raw('IFNULL(premium_features.status, 0) AS status'),            
            'premium_features.updated_at'
        )->rightJoin('features as f', function ($join) use($premium_id) {
            $join->on('f.id', '=', 'premium_features.feature_id')
                ->where('premium_features.premium_id', '=', $premium_id);
        })->get();
    }
    public function updateOrCreate(int $premiumid,int $featureid, bool $status)
    {
        $query = $this->model::where('premium_id',$premiumid)
                            ->where('feature_id',$featureid);
        if($query->first()!=null)
        {
            return $query->update([
                'status'=>$status
            ]);
        }
        return $this->model::created([
            "premium_id"=>$premiumid,
            "feature_id"=>$featureid,
            "status"=>$status
        ]);
    }
    public function createOrDelete($premium,int $featureid, bool $create,?bool $hold = false)
    {
        
        if($create)
        {
            $this->create([
                "premium_id"=>$premium->id,
                "feature_id"=>$featureid
            ]);
            $this->model::join("premiums","premiums.id","=","premium_features.premium_id")
                            ->where("premiums.level",">",$premium->level)                              
                            ->where("feature_id",$featureid)->delete();
            return 1;
        }
        if($this->model::where("premium_id",$premium->id)->where("feature_id",$featureid)->delete() > 0)
        {            
            if($hold)
            {
                $premiums = Premium::where("premiums.level","=",$premium->level+1)->get();
                foreach($premiums as $premium)
                {
                    $this->create([
                        "premium_id"=>$premium->id,
                        "feature_id"=>$featureid
                    ]);
                }
            }
            return 1;
        }   
        return 0;                         
    }

}
