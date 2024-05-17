<?php

namespace Infinitypaul\LaravelPasswordHistoryValidation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Infinitypaul\LaravelPasswordHistoryValidation\Models\PasswordHistoryRepo;

class NotFromPasswordHistory implements Rule
{
    protected $user;
    protected $checkPrevious;

    /**
     * NotFromPasswordHistory constructor.
     *
     * @param  $user
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->checkPrevious = config('password-history.keep');
    }

    /**
     * {@inheritdoc}
     */
    public function passes($attribute, $value)
    {
        $passwordHistories = PasswordHistoryRepo::fetchUser($this->user, $this->checkPrevious);
        foreach ($passwordHistories as $passwordHistory) {
            if (Hash::check($value, $passwordHistory->password)) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function message()
    {
        return __('auth.password_history') == 'auth.password_history' ? 'The Password Has Been Used' : __('auth.password_history');
    }
}
