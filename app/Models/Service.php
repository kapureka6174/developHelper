<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        "user_id",
        "title",
        "description",
        "site_url",
        "github_url",
        "finished",
    ];

    public function techfields()
    {
        return $this->hasMany(Techfield::class);
    }

    public function Uris()
    {
        return $this->hasMany(Uri::class);
    }

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    protected $appends = [
      'liked_by_user',
    ];

    public function getLikedByUserAttribute()
    {
        if (Auth::guest()) {
            return false;
        } else {
            return $this->likes->pluck('user_id')->contains(Auth::id());
        }

    }
}
