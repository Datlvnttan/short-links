<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;
use Carbon\Carbon;

class PermissionService
{
    public static function getDataByRoleReturnJson(PermissionRepositoryInterface $permissionRepo,int $roleId)
    {               
        $data = PermissionService::getDataByRole($permissionRepo,$roleId);
        if(isset($data))        
            return ResponseJson::success(data:$data);
        return ResponseJson::failed("Role id does not exist");
    }
    public static function updateStatus(PermissionRepositoryInterface $permissionRepo, RoleRepositoryInterface $roleRepo, GroupRouteRepositoryInterface $groupRouteRepo,int $roleId,int $grouprouteid, bool $status)
    {        
        $role = $roleRepo->find($roleId);
        if(!isset($role))
            return ResponseJson::failed("Role id does not exist");
        $groupRoute = $groupRouteRepo->find($grouprouteid);
        if(!isset($groupRoute))
            return ResponseJson::failed("Route id does not exist");                 
        if($permissionRepo->createOrUpdate($roleId, $grouprouteid, $status)==-1)
            return ResponseJson::failed("This permission has been locked, you cannot update",401); 
        return ResponseJson::success("Update successful",data:Carbon::now());
        
    }
    public static function getDataByRole(PermissionRepositoryInterface $permissionRepo,int $roleId)
    {
        return $permissionRepo->getDataByRole($roleId);
    }
}

