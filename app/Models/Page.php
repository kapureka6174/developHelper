<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
        "requirement_id",
        "pagename",
    ];

    public function requirements()
    {
        return $this->belongsToMany(Requirement::class,'requirement_page');
    }

}
