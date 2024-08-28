<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Http\Controllers\Controller;
use App\Services\PersonalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalApiController extends Controller
{
    public function topUpMoney(Request $request)
    {
        return Call::TryCatchResponseJson(function () use ($request){
            return PersonalService::topUpMoney($request["amount_of_money"]);
        });
    }
}
