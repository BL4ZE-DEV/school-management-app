<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Subject;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'Mathematics',
                'code' => 'MTH',
            ],
            [
                'name' => 'English Language',
                'code' => 'ENG',
            ],
            [
                'name' => 'Basic Science',
                'code' => 'BSC',
            ],
            [
                'name' => 'Social Studies',
                'code' => 'SOS',
            ],
            [
                'name' => 'Civic Education',
                'code' => 'CVE',
            ],
            [
                'name' => 'Computer Studies',
                'code' => 'CMP',
            ],
            [
                'name' => 'Physics',
                'code' => 'PHY',
            ],
            [
                'name' => 'Chemistry',
                'code' => 'CHM',
            ],
            [
                'name' => 'Biology',
                'code' => 'BIO',
            ],
            [
                'name' => 'Economics',
                'code' => 'ECO',
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate(
                [
                    'code' => $subject['code'],
                ],
                $subject
            );
        }
    }
}