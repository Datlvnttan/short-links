<?php
namespace App\Helpers;

class SortHelper
{
    public static function parse($sort)
    {
        return $sort == 1 ? "asc" : "desc";
    }
    
}


