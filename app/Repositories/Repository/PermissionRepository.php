<?php
namespace App\Repositories\Repository;

use App\Models\Permission;
use App\Repositories\EloquentRepository;
use App\Repositories\Interface\PermissionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class  PermissionRepository extends EloquentRepository implements PermissionRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Permission::class;
    }    
    public function getDataByRole($roleId)
    {
        return $this->model::select(
            "gr.id",
            "gr.group_route_name",
            'gr.group_route_title',
            'gr.default',            
            DB::raw('IFNULL(permission.status, 0) AS status'),
            'lock',
            'permission.updated_at'
        )->rightJoin('group_routes as gr', function ($join) use($roleId) {
            $join->on('gr.id', '=', 'permission.group_route_id')
                ->where('permission.role_id', '=', $roleId);
        })->get();
    }
    public function createOrUpdate(int $roleId,int $groupRouteId, bool $status)
    {        
        $permission = $this->model::where("role_id",$roleId)
                                    ->where("group_route_id",$groupRouteId);
        if($permission->first() != null)
        {
            if($permission->first()->lock == true)
                return -1;
            $permission->update(
                ["status"=>$status]
            );
            // $permission->status = false;
            // $permission->save();
            return 1;
        }        
        $this->model::create([
            "role_id"=>$roleId,
            "group_route_id"=>$groupRouteId,
            "status"=>$status
        ]);
        return 0;        
    }
    public function getStatus($roleId,$routeName)
    {        
        $permission = $this->model::select("permission.status")
                                    ->join("group_routes","group_routes.id","=","group_route_id")
                                    ->join("route_list_groups","route_list_groups.group_route_id","=","group_routes.id")
                                    ->join("routes","routes.id","=","route_list_groups.route_id")
                                    ->where("role_id",$roleId)
                                    ->where("route_name",$routeName)
                                    ->first();
        if(isset($permission))
            return $permission->status;
        return false;
    }


    public function getRoutes($roleId)
    {        
        $permission = $this->model::distinct()->select("routes.*")
                                    ->join("group_routes","group_routes.id","=","group_route_id")
                                    ->join("route_list_groups","route_list_groups.group_route_id","=","group_routes.id")
                                    ->join("routes","routes.id","=","route_list_groups.route_id")
                                    ->where("role_id",$roleId)                                    
                                    ->get();
        if(isset($permission))
            return $permission->status;
        return false;
    }
}
