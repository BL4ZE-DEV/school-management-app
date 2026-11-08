<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\TenantUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantUserSeeder extends Seeder
{
    public function run(): void
    {
        TenantUser::updateOrCreate(
            [
                'email' => 'admin@ilead.test',
            ],
            [
                'user_id'=> Str::uuid(),
                'first_name' => 'Tenant',
                'last_name' => 'Admin',
                'password' => 'password',
                'phone' => null,
            ]
        );
    }
}