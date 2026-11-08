<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class TenantService
{
    public function store($request){
        
        $request['database'] = 'tenant_'.strtolower($request->subdomain);

        $tenant = \App\Models\Tenant::create($request->all());

        if($this->createTenantDatabase($tenant->database) !== true){
            throw new \Exception("Could not create tenant database");
        }
        
        $this->runMigrations($tenant->database);

        return $tenant;
    }

    public function createTenantDatabase(string $dbName)
    {
        if(!DB::statement("CREATE DATABASE IF NOT EXISTS $dbName")){
            throw new \Exception("Could not create database: $dbName");
        }

        return true;
    }


    public function runMigrations(string $dbName)
    {
        Config()->set('database.connections.tenant.database', $dbName);
        Artisan::call('migrate',[
            '--database' => 'tenant',
            '--path' => 'database/migrations/tenant',
            '--force' => true,
        ]);
    }
}