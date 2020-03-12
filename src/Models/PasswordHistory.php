<?php

namespace Infinitypaul\LaravelPasswordHistoryValidation\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordHistory extends Model
{
    /**
     * PasswordHistory constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->table = config('password-history.table');
        parent::__construct($attributes);
    }

    protected $fillable = ['user_id', 'password'];
}
