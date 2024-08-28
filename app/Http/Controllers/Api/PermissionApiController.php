<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\RespositoryControllers\PermissionRepositoryController;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionApiController extends PermissionRepositoryController
{
    protected $roleRepo,$groupRouteRepo;
    public function __construct(PermissionRepositoryInterface $permissionRepo, RoleRepositoryInterface $roleRepo, GroupRouteRepositoryInterface $groupRouteRepo)
    {
        parent::__construct($permissionRepo);
        $this->permissionRepo = $permissionRepo;        
        $this->roleRepo = $roleRepo;        
        $this->groupRouteRepo = $groupRouteRepo;        
    }
    public function getDataByRole(Request $request)
    {
        return Call::TryCatchResponseJson(function() use($request){
            return PermissionService::getDataByRoleReturnJson($this->permissionRepo,$request->roleid);
        });
    }
    public function updateStatus(Request $request)
    {
        //return ResponseJson::success(data:boolval($request->status));
        return Call::TryCatchResponseJson(function() use($request){
            return PermissionService::updateStatus($this->permissionRepo,$this->roleRepo,$this->groupRouteRepo,$request->roleid,$request->grouprouteid,$request->status=="true");
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Call::TryCatchResponseJson(function() use($request){
            if(isset($request->roleid))
                return PermissionService::getDataByRole($this->permissionRepo,$request->roleid);
            return $this->permissionRepo->all();
        });        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
