<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SeedTenant extends Command
{
    protected $signature = 'tenant:seed {tenant}';

    protected $description = 'Seed a tenant database';

    public function handle(): int
    {
        $tenant = Tenant::where(
            'subdomain',
            $this->argument('tenant')
        )->first();

        if (! $tenant) {
            $this->error('Tenant not found.');

            return self::FAILURE;
        }

        Config::set(
            'database.connections.tenant.database',
            $tenant->database
        );

        DB::purge('tenant');
        DB::reconnect('tenant');

        $this->info(
            "Seeding database for tenant: {$tenant->subdomain}"
        );

        Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\TenantDatabaseSeeder',
            '--force' => true,
        ]);

        $this->line(Artisan::output());

        return self::SUCCESS;
    }
}