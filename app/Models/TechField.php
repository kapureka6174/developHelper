<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechField extends Model
{
    use HasFactory;

    protected $table = 'techfields';

    protected $fillable = [
        'service_id',
        'fieldname'
    ];

    public function tech()
    {
        return $this->hasMany(Tech::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
