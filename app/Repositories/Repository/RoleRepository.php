<?php
namespace App\Repositories\Repository;

use App\Helpers\SortHelper;
use App\Repositories\EloquentRepository;
use App\Repositories\Interface\RoleRepositoryInterface;

class RoleRepository extends EloquentRepository implements RoleRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Role::class;
    }    

}
