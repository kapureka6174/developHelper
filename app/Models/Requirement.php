<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    protected $table = 'requirements';

    protected $fillable = [
        "service_id",
        "title",
        "content",
    ];

    public function pages() {
        return $this->belongsToMany(Page::class,'requirement_page');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
