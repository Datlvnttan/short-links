<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumFeature extends Model
{
    use HasFactory;
    protected $table = "premium_features";
    protected $fillable = [
        'feature_id',
        'premium_id',
        'status',
        'temporary_lock'
    ];
    protected $casts = [
        'status' => 'boolean',   
        'temporary_lock' => 'boolean',
    ];
}
