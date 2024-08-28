<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;
    protected $table = "short_url";
    protected $fillable = [
        'original_link',
        'shortened_link',
        'user_id',
        'title',
        'effective_time',
        'limit_visits',        
        'expired',
        'flag_custom',
        'path_qrcode'
    ];
    protected $casts = [
        'flag_custom' => 'boolean',                
    ];
    public function get($shortened_link)
    {
        if($shortened_link == $this->shortened_link)
            return $this->original_link;
    }
}
