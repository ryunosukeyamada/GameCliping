<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Clip extends Model
{
    protected $fillable = ['title'];

    public function user(): BelongsTo{
        return $this -> belongsTo('App\User');
    }
    // likesテーブル
    public function likes(): BelongsToMany {
        return $this -> belongsToMany('App\User','likes')->withTimestamps();
    }
    // いいね判断
    public function isLikedBy(?USer $user): bool {
        return $user? (bool)$this->likes->where('id', $user->id)->count() : false;
    }
    // いいね数
    public function getLikesCountAttribute(){
        return $this->likes->count();
    }
    
    // tagsテーブル
    public function tags(): BelongsToMany {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    
}
