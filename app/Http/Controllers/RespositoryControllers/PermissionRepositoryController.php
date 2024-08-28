<?php

namespace App\Http\Controllers\RespositoryControllers;

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;

class PermissionRepositoryController extends Controller
{
    protected $permissionRepo;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(PermissionRepositoryInterface $permissionRepo)
    {
        // parent::__construct();
        $this->permissionRepo = $permissionRepo;        
    }
}
