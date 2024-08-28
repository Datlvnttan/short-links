<?php

namespace App\Http\Middleware;

use App\Repositories\Interface\PermissionRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    protected $permissionRepo;
    public function __construct(PermissionRepositoryInterface $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }  
    protected function check($user) 
    {        
        $routeName =  explode(".", Route::currentRouteName())[1];
        $status = $this->permissionRepo->getStatus($user["role_id"],$routeName);
        return $status;
    }
}
