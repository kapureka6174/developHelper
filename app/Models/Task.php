<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        "service_id",
        "taskname",
        "state",
        "time",
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
