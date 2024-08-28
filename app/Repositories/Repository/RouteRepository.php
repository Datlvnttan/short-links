<?php
namespace App\Repositories\Repository;

use App\Repositories\EloquentRepository;
use App\Repositories\Interface\RouteRepositoryInterface;

class RouteRepository extends EloquentRepository implements RouteRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Route::class;
    }    

}
