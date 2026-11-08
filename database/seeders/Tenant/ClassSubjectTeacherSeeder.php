<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\ClassSubject;
use App\Models\Tenant\ClassSubjectTeacher;
use App\Models\Tenant\Teacher;
use App\Models\Tenant\TenantUser;
use App\Models\Tenant\Term;
use Illuminate\Database\Seeder;

class ClassSubjectTeacherSeeder extends Seeder
{
    public function run(): void
    {
        $firstTerm = Term::where('name', 'First Term')->firstOrFail();

        $johnUser = TenantUser::where('email', 'john.ade@ilead.test')->firstOrFail();
        $maryUser = TenantUser::where('email', 'mary.okafor@ilead.test')->firstOrFail();

        $john = Teacher::where('user_id', $johnUser->id)->firstOrFail();
        $mary = Teacher::where('user_id', $maryUser->id)->firstOrFail();

        $classSubjects = ClassSubject::with(['schoolClass', 'subject'])->get();

        foreach ($classSubjects as $classSubject) {

            $teacher = match ($classSubject->subject->code) {
                'MTH', 'BSC' => $john,
                'ENG', 'CMP' => $mary,
                default => null,
            };

            if (! $teacher) {
                continue;
            }

            ClassSubjectTeacher::updateOrCreate(
                [
                    'class_subject_id' => $classSubject->id,
                    'teacher_id' => $teacher->id,
                    'term_id' => $firstTerm->id,
                ]
            );
        }
    }
}