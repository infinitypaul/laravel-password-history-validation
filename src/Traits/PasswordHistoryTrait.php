<?php

namespace Infinitypaul\LaravelPasswordHistoryValidation\Traits;

use Infinitypaul\LaravelPasswordHistoryValidation\Models\PasswordHistory;

trait PasswordHistoryTrait
{
    public function passwordHistory()
    {
        return $this->hasMany(PasswordHistory::class)
            ->latest();
    }

    public function deletePasswordHistory()
    {
        $this->passwordHistory()
            ->where('id', '<=', $this->passwordHistory()->first()->id - config('password-history.keep'))
            ->delete();
    }
}
