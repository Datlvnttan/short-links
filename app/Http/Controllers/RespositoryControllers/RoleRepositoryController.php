<?php

namespace App\Http\Controllers\RespositoryControllers;

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\RoleRepositoryInterface;

class RoleRepositoryController extends Controller
{
    protected $roleRepo;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(RoleRepositoryInterface $roleRepo)
    {
        //parent::__construct();
        $this->roleRepo = $roleRepo;        
    }
}
