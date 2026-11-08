<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Attendance;
use App\Models\Tenant\StudentEnrollment;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $enrollments = StudentEnrollment::all();

        $dates = [
            '2026-09-01',
            '2026-09-02',
            '2026-09-03',
            '2026-09-04',
            '2026-09-07',
        ];

        foreach ($enrollments as $enrollment) {
            foreach ($dates as $date) {

                Attendance::updateOrCreate(
                    [
                        'student_enrollment_id' => $enrollment->id,
                        'date' => $date,
                    ],
                    [
                        'status' => collect([
                            'Present',
                            'Present',
                            'Present',
                            'Late',
                            'Absent',
                        ])->random(),
                    ]
                );
            }
        }
    }
}