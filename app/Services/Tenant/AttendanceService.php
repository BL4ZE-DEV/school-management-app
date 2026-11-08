<?php

namespace App\Services\Tenant;

use App\Models\Tenant\Attendance;
use App\Models\Tenant\StudentEnrollment;
use Illuminate\Support\Facades\DB;

class AttendanceService
{
    public function getClassAttendance(
        int $classId,
        int $academicSessionId,
        string $date
    ) {
        return StudentEnrollment::with([
            'student.user',
            'attendance' => function ($query) use ($date) {
                $query->where('date', $date);
            }
        ])
        ->where('school_class_id', $classId)
        ->where('academic_session_id', $academicSessionId)
        ->where('status', 'active')
        ->get();
    }

    public function markAttendance(array $data)
    {
        return DB::transaction(function () use ($data) {

            foreach ($data['students'] as $student) {

                Attendance::updateOrCreate(
                    [
                        'student_enrollment_id' =>
                            $student['student_enrollment_id'],

                        'date' => $data['date'],
                    ],
                    [
                        'status' => $student['status'],
                    ]
                );
            }

            return true;
        });
    }

    public function getStudentAttendance(int $enrollmentId)
    {
        return Attendance::where(
            'student_enrollment_id',
            $enrollmentId
        )
        ->orderBy('date', 'desc')
        ->get();
    }
}