<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $casts = [
        'role_manager' => 'boolean',
        'lock'=>'boolean'                
    ];
    protected $fillable = [
        'role_name',
        'role_manager',
        'priority',
        'lock'
    ]; 
}
