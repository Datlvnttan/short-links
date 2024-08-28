<?php

namespace App\Http\Controllers\RespositoryControllers;

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\PremiumRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;

class PremiumRepositoryController extends Controller
{
    protected $premiumRepo;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(PremiumRepositoryInterface $premiumRepo)
    {
        // parent::__construct();
        $this->premiumRepo = $premiumRepo;        
    }
}
