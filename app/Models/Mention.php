<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentionable_id',
        'mentionable_type',
        'user_id',
    ];

    public function posts()
    {
        return $this->morphedByMany(Post::class,'mentionable');
    }

    public function stories()
    {
        return $this->morphedByMany(Story::class,'mentionable');
    }

}
