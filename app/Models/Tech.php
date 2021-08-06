<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tech extends Model
{
    use HasFactory;

    protected $table = 'teches';

    protected $fillable = [
        "tech_field_id",
        "techname",
        "version"
    ];

    public function techfield()
    {
        return $this->belongsTo(Techfield::class);
    }
}
