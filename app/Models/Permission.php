<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = "permission";

    protected $fillable = [
        'role_id',
        'group_route_id',
        'status',        
    ];
    protected $casts = [
        'role_id' => 'integer',
        'group_route_id' => 'integer',
        'status' => 'boolean',
        'lock'=> 'boolean',
    ];
    // public $primaryKey = [
    //     'group_route_id',
    //     'route_id'
    // ];
}
