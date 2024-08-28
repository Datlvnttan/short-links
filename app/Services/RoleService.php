<?php
namespace App\Services;

use App\Helpers\ResponseJson;

class RoleService
{
    public static function all($roleRepo)
    {  
        return ResponseJson::success(data:$roleRepo->all());          
    }
}

