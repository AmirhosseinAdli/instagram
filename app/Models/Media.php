<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';

    protected $fillable = [
        'path',
        'mediaable_type',
        'mediaable_id',
    ];

    public function mediaable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return Storage::url($this->attributes['path']);
    }
}
