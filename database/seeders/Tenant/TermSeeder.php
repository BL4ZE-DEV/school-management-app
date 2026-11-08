<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\AcademicSession;
use App\Models\Tenant\Term;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    public function run(): void
    {
        $session = AcademicSession::where('name', '2026/2027')->firstOrFail();

        $terms = [
            [
                'name' => 'First Term',
                'start_date' => '2026-09-01',
                'end_date' => '2026-12-18',
                'is_active' => true,
            ],
            [
                'name' => 'Second Term',
                'start_date' => '2027-01-11',
                'end_date' => '2027-04-02',
                'is_active' => false,
            ],
            [
                'name' => 'Third Term',
                'start_date' => '2027-04-26',
                'end_date' => '2027-07-23',
                'is_active' => false,
            ],
        ];

        foreach ($terms as $term) {
            Term::updateOrCreate(
                [
                    'academic_session_id' => $session->id,
                    'name' => $term['name'],
                ],
                [
                    'start_date' => $term['start_date'],
                    'end_date' => $term['end_date'],
                    'is_active' => $term['is_active'],
                ]
            );
        }
    }
}