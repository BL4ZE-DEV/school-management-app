<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Tenant Admin',
                'description' => 'Manages the school tenant and its users and configuration.',
            ],
            [
                'name' => 'Principal',
                'description' => 'Manages school operations and oversees academic activities.',
            ],
            [
                'name' => 'Vice Principal',
                'description' => 'Assists the principal and manages assigned school operations.',
            ],
            [
                'name' => 'Teacher',
                'description' => 'Manages assigned classes, students, attendance and academic results.',
            ],
            [
                'name' => 'Bursar',
                'description' => 'Manages school fees, payments and financial records.',
            ],
            [
                'name' => 'Student',
                'description' => 'Accesses personal academic and school information.',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                [
                    'name' => $role['name'],
                ],
                $role
            );
        }
    }
}