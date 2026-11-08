<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            ['name' => 'Administration', 'description' => 'Manage administrative tasks'],
            ['name' => 'Academics', 'description' => 'Manage academic activities'],
            ['name' => 'Bursary', 'description' => 'Manage financial aid and payments'],
            ['name' => 'Student Portal', 'description' => 'Manage student portal access and features'],
        ];

        foreach ($modules as $module) {
            \App\Models\Tenant\Module::UpdateOrCreate($module);
        }
    }


}
