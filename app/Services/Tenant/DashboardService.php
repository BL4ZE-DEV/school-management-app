<?php

namespace App\Services\Tenant;

use App\Models\Tenant\AcademicSession;
use App\Models\Tenant\Attendance;
use App\Models\Tenant\ClassSubjectTeacher;
use App\Models\Tenant\Grade;
use App\Models\Tenant\PaymentSubmission;
use App\Models\Tenant\SchoolClass;
use App\Models\Tenant\Student;
use App\Models\Tenant\StudentEnrollment;
use App\Models\Tenant\StudentFee;
use App\Models\Tenant\Subject;
use App\Models\Tenant\Teacher;
use App\Models\Tenant\Term;
use App\Models\Tenant\TenantUser;

class DashboardService
{
    public function dashboard(TenantUser $user): array
    {
        if ($user->hasRole('Tenant Admin')) {
            return $this->adminDashboard();
        }

        if (
            $user->hasRole('Principal') ||
            $user->hasRole('Vice Principal')
        ) {
            return $this->adminDashboard();
        }

        if ($user->hasRole('Teacher')) {
            return $this->teacherDashboard($user);
        }

        if ($user->hasRole('Bursar')) {
            return $this->bursarDashboard();
        }

        if ($user->hasRole('Student')) {
            return $this->studentDashboard($user);
        }

        return [
            'role' => 'unknown',
            'message' => 'No dashboard is configured for this user.',
        ];
    }

    private function adminDashboard(): array
    {
        $activeSession = AcademicSession::where('is_active', true)
            ->first();

        $activeTerm = null;

        if ($activeSession) {
            $activeTerm = Term::where(
                'academic_session_id',
                $activeSession->id
            )
            ->where('is_active', true)
            ->first();
        }

        $totalFeesDue = StudentFee::sum('amount_due');

        $totalPayments = PaymentSubmission::where(
            'status',
            'approved'
        )->sum('amount');

        return [
            'role' => 'admin',

            'academic_period' => [
                'session' => $activeSession,
                'term' => $activeTerm,
            ],

            'statistics' => [
                'students' => Student::count(),

                'teachers' => Teacher::count(),

                'classes' => SchoolClass::count(),

                'subjects' => Subject::count(),

                'active_enrollments' => StudentEnrollment::where(
                    'status',
                    'active'
                )->count(),

                'results_entered' => Grade::count(),
            ],

            'attendance_today' => [
                'present' => Attendance::whereDate(
                    'date',
                    today()
                )
                ->where('status', 'Present')
                ->count(),

                'absent' => Attendance::whereDate(
                    'date',
                    today()
                )
                ->where('status', 'Absent')
                ->count(),

                'late' => Attendance::whereDate(
                    'date',
                    today()
                )
                ->where('status', 'Late')
                ->count(),
            ],

            'bursary' => [
                'expected' => $totalFeesDue,

                'received' => $totalPayments,

                'outstanding' => max(
                    $totalFeesDue - $totalPayments,
                    0
                ),

                'pending_payments' => PaymentSubmission::where(
                    'status',
                    'pending'
                )->count(),
            ],

            'recent_payments' => PaymentSubmission::with([
                'studentFee.studentEnrollment.student',
            ])
            ->latest()
            ->limit(5)
            ->get(),
        ];
    }

    private function teacherDashboard(TenantUser $user): array
    {
        $teacher = $user->teacher;

        if (! $teacher) {
            return [
                'role' => 'teacher',
                'message' => 'Teacher profile not found.',
            ];
        }

        $assignments = ClassSubjectTeacher::with([
            'classSubject.schoolClass',
            'classSubject.subject',
            'classSubject.academicSession',
            'term',
        ])
        ->where('teacher_id', $teacher->id)
        ->get();

        $classIds = $assignments
            ->pluck('classSubject.class_id')
            ->filter()
            ->unique()
            ->values();

        $classSubjectIds = $assignments
            ->pluck('class_subject_id')
            ->unique()
            ->values();

        $studentCount = StudentEnrollment::whereIn(
            'school_class_id',
            $classIds
        )
        ->where('status', 'active')
        ->distinct('student_id')
        ->count('student_id');

        return [
            'role' => 'teacher',

            'teacher' => $teacher->load('user'),

            'statistics' => [
                'assigned_subjects' => $classSubjectIds->count(),

                'classes' => $classIds->count(),

                'students' => $studentCount,

                'results_entered' => Grade::whereIn(
                    'class_subject_id',
                    $classSubjectIds
                )->count(),
            ],

            'assignments' => $assignments,
        ];
    }

    private function bursarDashboard(): array
    {
        $expected = StudentFee::sum('amount_due');

        $received = PaymentSubmission::where(
            'status',
            'approved'
        )->sum('amount');

        $pendingAmount = PaymentSubmission::where(
            'status',
            'pending'
        )->sum('amount');

        return [
            'role' => 'bursar',

            'statistics' => [
                'expected_fees' => $expected,

                'confirmed_payments' => $received,

                'outstanding' => max(
                    $expected - $received,
                    0
                ),

                'pending_amount' => $pendingAmount,

                'pending_submissions' => PaymentSubmission::where(
                    'status',
                    'pending'
                )->count(),

                'approved_submissions' => PaymentSubmission::where(
                    'status',
                    'approved'
                )->count(),

                'rejected_submissions' => PaymentSubmission::where(
                    'status',
                    'rejected'
                )->count(),
            ],

            'pending_payments' => PaymentSubmission::with([
                'studentFee.studentEnrollment.student.user',
                'studentFee.studentEnrollment.schoolClass',
            ])
            ->where('status', 'pending')
            ->latest()
            ->limit(10)
            ->get(),

            'recent_payments' => PaymentSubmission::with([
                'studentFee.studentEnrollment.student.user',
            ])
            ->latest()
            ->limit(10)
            ->get(),
        ];
    }

    private function studentDashboard(TenantUser $user): array
    {
        $student = $user->student;

        if (! $student) {
            return [
                'role' => 'student',
                'message' => 'Student profile not found.',
            ];
        }

        $activeSession = AcademicSession::where(
            'is_active',
            true
        )->first();

        $activeTerm = null;

        if ($activeSession) {
            $activeTerm = Term::where(
                'academic_session_id',
                $activeSession->id
            )
            ->where('is_active', true)
            ->first();
        }

        $enrollmentQuery = StudentEnrollment::with([
            'schoolClass',
            'academicSession',
        ])
        ->where('student_id', $student->id);

        if ($activeSession) {
            $enrollmentQuery->where(
                'academic_session_id',
                $activeSession->id
            );
        }

        $enrollment = $enrollmentQuery
            ->latest('id')
            ->first();

        if (! $enrollment) {
            return [
                'role' => 'student',
                'student' => $student,
                'message' => 'No enrollment found.',
            ];
        }

        $fees = StudentFee::with([
            'feeStructure.term',
            'paymentSubmissions',
        ])
        ->where(
            'student_enrollment_id',
            $enrollment->id
        )
        ->get();

        $totalFee = $fees->sum(function ($fee) {
            return (float) $fee->amount_due;
        });

        $totalPaid = $fees->sum(function ($fee) {
            return (float) $fee->approved_total;
        });

        $pendingPayment = $fees->sum(function ($fee) {
            return (float) $fee->pending_total;
        });

        $attendanceQuery = Attendance::where(
            'student_enrollment_id',
            $enrollment->id
        );

        $attendanceTotal = (clone $attendanceQuery)->count();

        $presentCount = (clone $attendanceQuery)
            ->where('status', 'Present')
            ->count();

        $attendancePercentage = $attendanceTotal > 0
            ? round(
                ($presentCount / $attendanceTotal) * 100,
                2
            )
            : 0;

        $results = collect();

        if ($activeTerm) {
            $results = Grade::with([
                'classSubject.subject',
                'term',
            ])
            ->where(
                'student_enrollment_id',
                $enrollment->id
            )
            ->where(
                'term_id',
                $activeTerm->id
            )
            ->get();
        }

        return [
            'role' => 'student',

            'student' => $student->load('user'),    

            'academic_period' => [
                'session' => $activeSession,
                'term' => $activeTerm,
            ],

            'enrollment' => $enrollment,

            'fees' => [
                'total_fee' => $totalFee,

                'total_paid' => $totalPaid,

                'pending_payment' => $pendingPayment,

                'balance' => max(
                    $totalFee - $totalPaid,
                    0
                ),

                'is_cleared' => (
                    $totalFee > 0 &&
                    $totalPaid >= $totalFee
                ),
            ],

            'attendance' => [
                'total_days' => $attendanceTotal,

                'present' => $presentCount,

                'absent' => (clone $attendanceQuery)
                    ->where('status', 'Absent')
                    ->count(),

                'late' => (clone $attendanceQuery)
                    ->where('status', 'Late')
                    ->count(),

                'percentage' => $attendancePercentage,
            ],

            'results' => $results,
        ];
    }
}