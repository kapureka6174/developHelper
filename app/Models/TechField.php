<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechField extends Model
{
    use HasFactory;

    protected $table = 'tech_fields';

    protected $fillable = [
        'service_id',
        'fieldname'
    ];

    public function teches()
    {
        return $this->hasMany(Tech::class,'tech_field_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
