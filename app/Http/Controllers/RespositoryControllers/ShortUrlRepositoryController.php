<?php

namespace App\Http\Controllers\RespositoryControllers;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\ShortUrlRepositoryInterface;
use Illuminate\Http\Request;

class ShortUrlRepositoryController extends Controller
{
    protected $shortUrlRepo;
    public function __construct(ShortUrlRepositoryInterface $shortUrlRepo)
    {
        $this->shortUrlRepo = $shortUrlRepo;
    }
}
