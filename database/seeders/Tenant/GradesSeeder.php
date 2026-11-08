<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\ClassSubject;
use App\Models\Tenant\Grade;
use App\Models\Tenant\StudentEnrollment;
use App\Models\Tenant\Term;
use Illuminate\Database\Seeder;

class GradesSeeder extends Seeder
{
    public function run(): void
    {
        $firstTerm = Term::where('name', 'First Term')->firstOrFail();

        $enrollments = StudentEnrollment::with([
            'student.user',
            'schoolClass',
        ])->get();

        foreach ($enrollments as $enrollment) {

            $classSubjects = ClassSubject::where(
                'class_id',
                $enrollment->school_class_id
            )
            ->where(
                'academic_session_id',
                $enrollment->academic_session_id
            )
            ->get();

            foreach ($classSubjects as $classSubject) {

                Grade::updateOrCreate(
                    [
                        'student_enrollment_id' => $enrollment->id,
                        'class_subject_id' => $classSubject->id,
                        'term_id' => $firstTerm->id,
                    ],
                    [
                        'ca_score' => rand(20, 40),
                        'exam_score' => rand(30, 60),
                    ]
                );
            }
        }
    }
}