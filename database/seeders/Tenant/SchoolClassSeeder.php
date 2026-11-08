<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\SchoolClass;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            [
                'name' => 'JSS 1A',
                'level' => 'JSS 1',
            ],
            [
                'name' => 'JSS 1B',
                'level' => 'JSS 1',
            ],
            [
                'name' => 'JSS 2A',
                'level' => 'JSS 2',
            ],
            [
                'name' => 'JSS 3A',
                'level' => 'JSS 3',
            ],
            [
                'name' => 'SS 1A',
                'level' => 'SS 1',
            ],
            [
                'name' => 'SS 2A',
                'level' => 'SS 2',
            ],
            [
                'name' => 'SS 3A',
                'level' => 'SS 3',
            ],
        ];

        foreach ($classes as $class) {
            SchoolClass::updateOrCreate(
                [
                    'name' => $class['name'],
                    'level' => $class['level'],
                ],
                $class
            );
        }
    }
}