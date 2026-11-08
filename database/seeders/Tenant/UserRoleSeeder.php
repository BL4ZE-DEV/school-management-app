<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Role;
use App\Models\Tenant\TenantUser;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $user = TenantUser::where('email', 'admin@ilead.test')->firstOrFail();

        $role = Role::where('name', 'Tenant Admin')->firstOrFail();

        $user->roles()->syncWithoutDetaching([
            $role->id,
        ]);
    }
}