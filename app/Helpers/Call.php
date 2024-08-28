<?php
namespace App\Helpers;

use Closure;
use Exception;

class Call
{
    public static function TryCatchResponseJson(Closure $callBack) 
    {
        try
        {
            return $callBack();
        }
        catch(Exception $e)
        {
            return ResponseJson::error($e->getMessage());
        }
    }
    
}


