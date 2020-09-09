<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function getHashTagAttribute(): string {
        return '#' .$this->name;
    }
    public function clips(): BelongsToMany {
        return $this->belongsToMany('App\Clip', 'clip_tag')->withTimestamps();
    }
}
