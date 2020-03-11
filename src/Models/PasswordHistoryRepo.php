<?php

namespace Infinitypaul\LaravelPasswordHistoryValidation\Models;

class PasswordHistoryRepo
{
    public static function storeCurrentPasswordInHistory($password, $user_id)
    {
        PasswordHistory::create(get_defined_vars());
    }

    public static function fetchUser($user, $checkPrevious)
    {
        return PasswordHistory::where('user_id', $user->id)->latest()->take($checkPrevious)->get();
    }
}
