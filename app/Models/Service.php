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

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
