<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        "user_id",
        "title",
        "description"
    ];

    public function tag()
    {
        return $this->hasMany(Tag::class);
    }

    public function techfield()
    {
        return $this->hasMany(Techfield::class);
    }

    public function Uri()
    {
        return $this->hasMany(Uri::class);
    }

    public function requirement()
    {
        return $this->hasMany(Requirement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
