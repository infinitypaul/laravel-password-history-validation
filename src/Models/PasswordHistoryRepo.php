<?php

namespace Infinitypaul\LaravelPasswordHistoryValidation\Models;

class PasswordHistoryRepo
{
    /**
     * @param  $password
     * @param  $user_id
     */
    public static function storeCurrentPasswordInHistory($password, $user_id)
    {
        PasswordHistory::create(get_defined_vars());
    }

    /**
     * @param  $user
     * @param  $checkPrevious
     * @return mixed
     */
    public static function fetchUser($user, $checkPrevious)
    {
        return PasswordHistory::where('user_id', $user->id)->latest()->take($checkPrevious)->get();
    }
}
