<?php

namespace Infinitypaul\LaravelPasswordHistoryValidation\Observers;

use Illuminate\Support\Arr;
use Infinitypaul\LaravelPasswordHistoryValidation\Models\PasswordHistoryRepo;

class UserObserver
{
    public function updated($user)
    {
        $configPasswordColumn = config('password-history.observe.column');
        if ($password = Arr::get($user->getChanges(), $configPasswordColumn)) {
            PasswordHistoryRepo::storeCurrentPasswordInHistory($password, $user->id);
        }
    }

    public function created($user)
    {
        $password = config('password-history.observe.column') ?? 'password';
        PasswordHistoryRepo::storeCurrentPasswordInHistory($user->{$password}, $user->id);
    }
}
