<?php

namespace App\Http\Controllers\RespositoryControllers;

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\RouteRepositoryInterface;

class RouteRepositoryController extends Controller
{
    protected $routeRepo;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(RouteRepositoryInterface $routeRepo)
    {
        // parent::__construct();
        $this->routeRepo = $routeRepo;        
    }
}
