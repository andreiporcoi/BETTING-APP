<?php

namespace App\Policies;

use App\Models\PageControl;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PageControlPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasAnyRole([['super-admin', 'admin']]);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PageControl  $pageControl
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PageControl $pageControl)
    {
        return $user->hasAnyRole([['super-admin', 'admin']]);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole([['super-admin', 'admin']]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PageControl  $pageControl
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PageControl $pageControl)
    {
        return $user->hasAnyRole([['super-admin', 'admin']]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PageControl  $pageControl
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PageControl $pageControl)
    {
        return $user->hasAnyRole([['super-admin', 'admin']]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PageControl  $pageControl
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PageControl $pageControl)
    {
        return $user->hasAnyRole([['super-admin', 'admin']]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PageControl  $pageControl
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PageControl $pageControl)
    {
        return $user->hasAnyRole([['super-admin', 'admin']]);
    }
}
