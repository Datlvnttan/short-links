<?php

namespace App\Http\Controllers\RespositoryControllers;

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\PremiumFeatureRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;

class PremiumFeatureRepositoryController extends Controller
{
    protected $premiumFeature;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(PremiumFeatureRepositoryInterface $premiumFeature)
    {
        // parent::__construct();
        $this->premiumFeature = $premiumFeature;        
    }
}
