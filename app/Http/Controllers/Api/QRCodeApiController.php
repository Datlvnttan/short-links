<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RespositoryControllers\ShortUrlRepositoryController;
use App\Repositories\Interface\ShortUrlRepositoryInterface;
use App\Services\QRCodeService;
use Illuminate\Http\Request;

class QRCodeApiController extends ShortUrlRepositoryController
{
    private $qrcodeService;
    public function __construct(ShortUrlRepositoryInterface $shortUrlRepo)
    {        
        $this->qrcodeService = new QRCodeService($shortUrlRepo);
    }   
    public function show(string $shortened_link)
    {
        return Call::TryCatchResponseJson(function() use ($shortened_link) {
            return $this->qrcodeService->GetQRCode($shortened_link);
        });
    }
}
