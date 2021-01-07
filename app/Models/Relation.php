<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_id',
        'followed_id',
        'is_accepted',
    ];

    public function follower()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
