<?php

namespace App\Http\Controllers\RespositoryControllers;

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\FeatureRepositoryInterface;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;

class FeatureRepositoryController extends Controller
{
    protected $reatureRepo;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(FeatureRepositoryInterface $reatureRepo)
    {
        // parent::__construct();
        $this->reatureRepo = $reatureRepo;        
    }
}
