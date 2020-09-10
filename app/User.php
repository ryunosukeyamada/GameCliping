<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile_image'
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

    // そのユーザーがどのユーザーにフォローされているかの取得
    public function followers() : BelongsToMany {
        return $this->belongsToMany('App\User','follows','follower_id', 'follow_id')->withTimestamps();
    }
    // そのユーザーが誰をフォローしているのかの取得
    public function follows(): BelongsToMany {
        return $this->belongsToMany('App\User','follows','follow_id','follower_id')->withTimestamps();
    }

    // フォローしているかチェック
    public function isFollowdBy(?User $user): bool {
        return $user? (bool)$this->followers->where('id',$user->id)->count(): false;
    }
}
