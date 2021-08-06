<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uri extends Model
{
    use HasFactory;

    protected $table = 'uris'

    protected $fillable = [
        'service_id',
        'uri',
        'method',
        'explain',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
