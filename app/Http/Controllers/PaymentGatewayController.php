<?php

namespace App\Http\Controllers;

use App\Services\MomoService;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    public function gatewayMomo(Request $request)
    {        
        return MomoService::gatewayMomo();
    }
}
