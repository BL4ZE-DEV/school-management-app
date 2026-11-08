<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\AcademicSession;
use Illuminate\Database\Seeder;

class AcademicSessionSeeder extends Seeder
{
    public function run(): void
    {
        $sessions = [
            [
                'name' => '2025/2026',
                'start_date' => '2025-09-01',
                'end_date' => '2026-07-31',
                'is_active' => false,
            ],
            [
                'name' => '2026/2027',
                'start_date' => '2026-09-01',
                'end_date' => '2027-07-31',
                'is_active' => true,
            ],
        ];

        foreach ($sessions as $session) {
            AcademicSession::updateOrCreate(
                ['name' => $session['name']],
                $session
            );
        }
    }
}