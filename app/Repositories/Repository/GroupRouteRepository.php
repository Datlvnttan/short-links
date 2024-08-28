<?php
namespace App\Repositories\Repository;

use App\Repositories\EloquentRepository;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;

class GroupRouteRepository extends EloquentRepository implements GroupRouteRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\GroupRoute::class;
    }    

}
