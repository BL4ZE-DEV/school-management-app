<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\AcademicSession;
use App\Models\Tenant\SchoolClass;
use App\Models\Tenant\Student;
use App\Models\Tenant\StudentEnrollment;
use Illuminate\Database\Seeder;

class StudentEnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $session = AcademicSession::where('name', '2026/2027')->firstOrFail();

        $david = Student::whereHas('user', function ($query) {
            $query->where('email', 'david.adebayo@ilead.test');
        })->firstOrFail();

        $sarah = Student::whereHas('user', function ($query) {
            $query->where('email', 'sarah.okon@ilead.test');
        })->firstOrFail();

        $jss1A = SchoolClass::where('name', 'JSS 1A')->firstOrFail();
        $jss2A = SchoolClass::where('name', 'JSS 2A')->firstOrFail();

        StudentEnrollment::updateOrCreate(
            [
                'student_id' => $david->id,
                'academic_session_id' => $session->id,
            ],
            [
                'school_class_id' => $jss1A->id,
                'enrollment_date' => '2026-09-01',
                'status' => 'active',
            ]
        );

        StudentEnrollment::updateOrCreate(
            [
                'student_id' => $sarah->id,
                'academic_session_id' => $session->id,
            ],
            [
                'school_class_id' => $jss2A->id,
                'enrollment_date' => '2026-09-01',
                'status' => 'active',
            ]
        );
    }
}