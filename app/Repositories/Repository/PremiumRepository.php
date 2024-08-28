<?php
namespace App\Repositories\Repository;

use App\Repositories\EloquentRepository;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\PremiumRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;

class PremiumRepository extends EloquentRepository implements PremiumRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Premium::class;
    }    
    public function getLevel()
    {
        return $this->model::distinct()
                ->select("level")
                ->orderBy("level","desc")
                ->get();
    }
    public function getDataFeatureWithSmallerLevels(int $id, $level)
    {
        return $this->model::select('premiums.level', 'premiums.id as premium_id', 
                'premiums.premium_name', 'features.id as feature_id', 'feature_name', 'feature_title', 'attribute', 'pf.updated_at')
                ->join('premium_features as pf', function ($join) use($id, $level){
                    $join->on('premiums.id', '=', 'pf.premium_id')
                        ->where(function ($query) use($id, $level){
                            $query->where('premiums.id', $id)
                                ->orWhere('premiums.level', '<', $level);
                        });
                })
                ->rightJoin('features', 'pf.feature_id', '=', 'features.id')
                ->distinct()
                ->orderBy('features.id','ASC')
                ->get();

    }
}
