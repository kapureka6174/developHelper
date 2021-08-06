<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        "service_id",
        "tagname"
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
