<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequirementPage extends Model
{
    use HasFactory;

    protected $table = 'requirement_page';

    protected $fillable = [
        "requirement_id",
        "page_id",
    ];
}
