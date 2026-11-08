<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\AcademicSession;
use App\Models\Tenant\ClassSubject;
use App\Models\Tenant\SchoolClass;
use App\Models\Tenant\Subject;
use Illuminate\Database\Seeder;

class ClassSubjectSeeder extends Seeder
{
    public function run(): void
    {
        $session = AcademicSession::where('name', '2026/2027')->firstOrFail();

        $jss1A = SchoolClass::where('name', 'JSS 1A')->firstOrFail();
        $jss2A = SchoolClass::where('name', 'JSS 2A')->firstOrFail();

        $mathematics = Subject::where('code', 'MTH')->firstOrFail();
        $english = Subject::where('code', 'ENG')->firstOrFail();
        $basicScience = Subject::where('code', 'BSC')->firstOrFail();
        $computerStudies = Subject::where('code', 'CMP')->firstOrFail();

        $classSubjects = [
            [
                'class_id' => $jss1A->id,
                'subject_id' => $mathematics->id,
            ],
            [
                'class_id' => $jss1A->id,
                'subject_id' => $english->id,
            ],
            [
                'class_id' => $jss1A->id,
                'subject_id' => $basicScience->id,
            ],
            [
                'class_id' => $jss2A->id,
                'subject_id' => $mathematics->id,
            ],
            [
                'class_id' => $jss2A->id,
                'subject_id' => $english->id,
            ],
            [
                'class_id' => $jss2A->id,
                'subject_id' => $computerStudies->id,
            ],
        ];

        foreach ($classSubjects as $classSubject) {
            ClassSubject::updateOrCreate(
                [
                    'class_id' => $classSubject['class_id'],
                    'subject_id' => $classSubject['subject_id'],
                    'academic_session_id' => $session->id,
                ],
                []
            );
        }
    }
}