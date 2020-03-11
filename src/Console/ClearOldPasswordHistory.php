<?php

namespace Infinitypaul\LaravelPasswordHistoryValidation\Console;

use Illuminate\Console\Command;

class ClearOldPasswordHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password-history:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Old Password History';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Getting Users...');
        $model = config('password-history.observe.model');
        if (class_exists($model)) {
            $model::chunk(100, function ($users) {
                $users->each->deletePasswordHistory();
            });
        }
        $this->info('Old Password Cleared...');
    }
}
