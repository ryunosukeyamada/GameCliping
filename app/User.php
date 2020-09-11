<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile_image','caption'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // そのユーザーが投稿したクリップを取得
    public function clips(): HasMany {
        return $this->hasMany('App\Clip');
    }
    // そのユーザーがいいねしたクリップの取得
    public function likes(): BelongsToMany {
        return $this->belongsToMany('App\Clip','likes')->withTimestamps();
    }

    // そのユーザーがどのユーザーにフォローされているかの取得
    public function followers() : BelongsToMany {
        return $this->belongsToMany('App\User','follows','follower_id', 'follow_id')->withTimestamps();
    }
    // そのユーザーが誰をフォローしているのかの取得
    public function follows(): BelongsToMany {
        return $this->belongsToMany('App\User','follows','follow_id','follower_id')->withTimestamps();
    }
    // フォロワーの数
    public function getCountFollowersAttribute(): int 
    {
        return $this->followers->count();
    }
    // フォローしている数
    public function getCountFollowsAttribute(): int
    {
        return $this->follows->count();
    }


    // フォローしているかチェック
    public function isFollowdBy(?User $user): bool {
        return $user? (bool)$this->followers->where('id',$user->id)->count(): false;
    }
}
