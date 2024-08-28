<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Models\Premium;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Str;

class  PersonalService
{
    public static function topUpMoney($amount_of_money)
    {
        return MomoService::gatewayMomo2("Nạp tiền vào tài khoản",$amount_of_money,);
    }
}

