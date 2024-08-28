<?php

namespace App\Http\Controllers\RespositoryControllers;

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserRepositoryController extends Controller
{
    protected $userRepo;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        // parent::__construct();
        $this->userRepo = $userRepo;        
    }
}
