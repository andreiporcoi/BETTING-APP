<?php

namespace App\Policies;

use App\Models\InvestmentsHistory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvestmentsHistoryPolicy
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
        return $user->hasAnyRole([['super-admin', 'admin', 'investments','transactions' ]]);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InvestmentsHistory  $investmentsHistory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, InvestmentsHistory $investmentsHistory)
    {
        return $user->hasAnyRole([['super-admin', 'admin', 'investments','transactions' ]]);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole([['super-admin', 'admin', 'investments','transactions' ]]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InvestmentsHistory  $investmentsHistory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, InvestmentsHistory $investmentsHistory)
    {
        return $user->hasAnyRole([['super-admin', 'admin', 'investments','transactions' ]]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InvestmentsHistory  $investmentsHistory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, InvestmentsHistory $investmentsHistory)
    {
        return $user->hasAnyRole([['super-admin', 'admin', 'investments','transactions' ]]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InvestmentsHistory  $investmentsHistory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, InvestmentsHistory $investmentsHistory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InvestmentsHistory  $investmentsHistory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, InvestmentsHistory $investmentsHistory)
    {
        //
    }
}
