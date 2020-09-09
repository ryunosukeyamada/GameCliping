<?php

namespace App\Policies;

use App\Clip;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ClipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any clips.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the clip.
     *
     * @param  \App\User  $user
     * @param  \App\Clip  $clip
     * @return mixed
     */
    public function view(?User $user, Clip $clip)
    {
        return true;
    }

    /**
     * Determine whether the user can create clips.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the clip.
     *
     * @param  \App\User  $user
     * @param  \App\Clip  $clip
     * @return mixed
     */
    public function update(User $user, Clip $clip)
    {
        return $user->id === $clip->user_id
        ?Response::allow() : Response::deny('あなたの投稿ではないため編集することはできません');
    }

    /**
     * Determine whether the user can delete the clip.
     *
     * @param  \App\User  $user
     * @param  \App\Clip  $clip
     * @return mixed
     */
    public function delete(User $user, Clip $clip)
    {
        return $user->id === $clip->user_id
        ? Response::allow() : Response::deny('あなたの投稿ではないため削除することはできません');
    }

    /**
     * Determine whether the user can restore the clip.
     *
     * @param  \App\User  $user
     * @param  \App\Clip  $clip
     * @return mixed
     */
    public function restore(User $user, Clip $clip)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the clip.
     *
     * @param  \App\User  $user
     * @param  \App\Clip  $clip
     * @return mixed
     */
    public function forceDelete(User $user, Clip $clip)
    {
        //
    }
}
