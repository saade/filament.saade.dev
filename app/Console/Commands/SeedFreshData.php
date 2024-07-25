<?php

namespace App\Console\Commands;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;

class SeedFreshData extends Command
{
    protected $signature = 'app:seed-fresh-data {user}';

    protected $description = 'Seed fresh data just for the provided user.';

    public function handle()
    {
        tap(
            $this->argument('user'),
            fn (int $userId) => (new DatabaseSeeder)->run($userId)
        );
    }
}
