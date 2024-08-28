<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupRoute extends Model
{
    use HasFactory;
    protected $fillable = [        
        'group_route_name',
        'group_route_title',   
        'default'     
    ];   
    protected $casts = [
        'default' => 'boolean',                
    ];
}
