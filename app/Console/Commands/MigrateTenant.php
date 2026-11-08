<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class MigrateTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:migrate {tenant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the database for a specific tenant';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $tenant = Tenant::where('subdomain', $this->argument('tenant'))->first();

        if (!$tenant) {
            $this->error("Tenant not found.");
            return self::FAILURE;
        }

        // Set the tenant connection
        config(['database.connections.tenant.database' => $tenant->database]);

        DB::purge('tenant');
        DB::reconnect('tenant');

        $this->info("Migrating database for tenant: {$tenant->subdomain}");

        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => 'database/migrations/tenant',
            '--force' => true,
        ]);

        $this->line(Artisan::output());
        $this->info('Tenant Migration Completed successfully.');        
        
        return self::SUCCESS;
    }
}
