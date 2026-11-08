<?php

namespace App\Services\Tenant;

use App\Models\Tenant\ClassSubject;
use App\Models\Tenant\Grade;
use App\Models\Tenant\StudentEnrollment;
use App\Models\Tenant\Term;
use Illuminate\Support\Facades\DB;

class ResultService
{
    public function getResultSheet(int $classSubjectId,int $termId) 
    {
        $classSubject = ClassSubject::with(['schoolClass','subject','academicSession',])->findOrFail($classSubjectId);

        $term = Term::findOrFail($termId);

        $enrollments = StudentEnrollment::with(['student.user',])
        ->where('school_class_id', $classSubject->class_id)
        ->where('academic_session_id',$classSubject->academic_session_id)
        ->where('status', 'active')
        ->get();

        $grades = Grade::where('class_subject_id',$classSubjectId)
        ->where('term_id', $termId)
        ->get()
        ->keyBy('student_enrollment_id');

        return [
            'class_subject' => $classSubject,
            'term' => $term,
            'students' => $enrollments->map(function ($enrollment) use ($grades) {

                $grade = $grades->get($enrollment->id);

                return [
                    'student_enrollment_id' => $enrollment->id,

                    'student' => $enrollment->student,

                    'grade' => $grade ? [
                        'ca_score' => $grade->ca_score,
                        'exam_score' => $grade->exam_score,
                        'total_score' => $grade->total_score,
                    ] : null,
                ];
            }),
        ];
    }

    public function saveResults(array $data)
    {
        return DB::transaction(function () use ($data) {

            $classSubject = ClassSubject::findOrFail( $data['class_subject_id']);

            Term::findOrFail($data['term_id']);

            $savedGrades = [];

            foreach ($data['students'] as $studentData) {

                $enrollment = StudentEnrollment::where('id',$studentData['student_enrollment_id'])
                ->where('school_class_id',$classSubject->class_id)
                ->where('academic_session_id',$classSubject->academic_session_id)
                ->where('status', 'active')
                ->firstOrFail();

                $grade = Grade::updateOrCreate(
                    [
                        'student_enrollment_id' => $enrollment->id,
                        'class_subject_id' => $classSubject->id,
                        'term_id' => $data['term_id'],
                    ],
                    [
                        'ca_score' => $studentData['ca_score'],
                        'exam_score' => $studentData['exam_score'],
                    ]
                );

                $savedGrades[] = $grade;
            }

            return $savedGrades;
        });
    }

    public function getStudentResults(int $studentEnrollmentId,int $termId) {
        return Grade::with(['classSubject.subject','term',])
        ->where('student_enrollment_id',$studentEnrollmentId)
        ->where('term_id', $termId)
        ->get();
    }
}


