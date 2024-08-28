<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
    use HasFactory;
    protected $table = "premiums";
    protected $fillable = [
        'premium_name',
        'premium_title',
        'premium_icon',
        'level',
        'billing_cycle',
        'upgrade_costs',
        'upgrade_costs',
        'limit_create_custom_link',
        'limit_create_qrcode',
        'link_lifespan'
    ];    


    
}
