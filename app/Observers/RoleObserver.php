<?php

namespace App\Observers;

use App\Models\GroupRoute;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {        
        $groupRoutes = GroupRoute::where("default",true)->get();
        foreach ($groupRoutes as $groupRoute) {
            Permission::create([
                "role_id"=>$role->id,
                "group_route_id"=>$groupRoute->id,
                "status"=>true,
                "lock"=>true
            ]);
        }
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "restored" event.
     */
    public function restored(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     */
    public function forceDeleted(Role $role): void
    {
        //
    }
}
