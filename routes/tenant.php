<?php

use App\Http\Controllers\Tenant\AttendanceController;
use App\Http\Controllers\Tenant\AcademicSessionController;
use App\Http\Controllers\Tenant\ClassSubjectController;
use App\Http\Controllers\Tenant\ClassSubjectTeacherController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\FeeStructureController;
use App\Http\Controllers\Tenant\PaymentSubmissionController;
use App\Http\Controllers\Tenant\ResultController;
use App\Http\Controllers\Tenant\SchoolClassController;
use App\Http\Controllers\Tenant\StudentController;
use App\Http\Controllers\Tenant\StudentEnrollmentController;
use App\Http\Controllers\Tenant\StudentFeeController;
use App\Http\Controllers\Tenant\SubjectController;
use App\Http\Controllers\Tenant\TeacherController;
use App\Http\Controllers\Tenant\TenantAuthController;
use App\Http\Controllers\Tenant\TenantUserController;
use App\Http\Controllers\Tenant\TermController;
use Illuminate\Support\Facades\Route;

Route::domain('{tenant}.' . config('app.domain'))->middleware('tenant')->group(function () {
        Route::post('/login', [TenantAuthController::class,'login'])->name('tenant.login');

        Route::middleware(['auth:tenant','tenant.jwt'])->group(function () {

            Route::get('/me', [TenantUserController::class,'me'])->name('tenant.me');

            Route::post('/logout', [TenantUserController::class,'logout'])->name('tenant.logout');

            Route::post('/refresh', [TenantUserController::class,'refresh'])->name('tenant.refresh');



            Route::get('/academic-sessions', [AcademicSessionController::class,'index'])->middleware('permission:academic_sessions.view');

            Route::post('/academic-sessions', [AcademicSessionController::class,'store'])->middleware('permission:academic_sessions.create');

            Route::get('/academic-sessions/current', [AcademicSessionController::class,'getCurrentSession'])->middleware('permission:academic_sessions.view');

            Route::get('/academic-sessions/{id}', [AcademicSessionController::class,'show'])->middleware('permission:academic_sessions.view');

            Route::put('/academic-sessions/{id}', [AcademicSessionController::class,'update'])->middleware('permission:academic_sessions.update');

            Route::patch('/academic-sessions/{id}/activate', [AcademicSessionController::class,'activateSession'])->middleware('permission:academic_sessions.activate');

            Route::delete('/academic-sessions/{id}', [AcademicSessionController::class,'destroy'])->middleware('permission:academic_sessions.delete');


            // Terms

            Route::get('/terms', [TermController::class,'index'])->middleware('permission:terms.view');

            Route::post('/terms', [TermController::class,'store'])->middleware('permission:terms.create');

            Route::get('/terms/{id}', [TermController::class,'show'])->middleware('permission:terms.view');

            Route::put('/terms/{id}', [TermController::class,'update'])->middleware('permission:terms.update');

            Route::delete('/terms/{id}', [TermController::class,'destroy'])->middleware('permission:terms.delete');

            Route::patch('/terms/{id}/activate', [TermController::class,'activate'])->middleware('permission:terms.update');


      
            Route::get('/classes', [SchoolClassController::class, 'index'])->middleware('permission:classes.view');

            Route::post('/classes', [SchoolClassController::class, 'store'])->middleware('permission:classes.create');

            Route::get('/classes/{id}', [SchoolClassController::class, 'show'])->middleware('permission:classes.view');

            Route::put('/classes/{id}', [SchoolClassController::class, 'update'])->middleware('permission:classes.update');

            Route::delete('/classes/{id}', [SchoolClassController::class, 'destroy'])->middleware('permission:classes.delete');


            Route::get('/subjects', [SubjectController::class, 'index'])->middleware('permission:subjects.view');

            Route::post('/subjects', [SubjectController::class, 'store'])->middleware('permission:subjects.create');

            Route::get('/subjects/{id}', [SubjectController::class, 'show'])->middleware('permission:subjects.view');

            Route::put('/subjects/{id}', [SubjectController::class, 'update'])->middleware('permission:subjects.update');
            Route::delete('/subjects/{id}', [SubjectController::class, 'destroy'])->middleware('permission:subjects.delete');


            // Teachers
            Route::get('/teachers', [TeacherController::class, 'index'])->middleware('permission:teachers.view');

            Route::post('/teachers', [TeacherController::class, 'store'])->middleware('permission:teachers.create');

            Route::get('/teachers/{id}', [TeacherController::class, 'show'])->middleware('permission:teachers.view');

            Route::put('/teachers/{id}', [TeacherController::class, 'update'])->middleware('permission:teachers.update');

            Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->middleware('permission:teachers.delete');


            // Students
            Route::get('/students', [StudentController::class, 'index'])->middleware('permission:students.view');

            Route::post('/students/admit', [StudentController::class, 'admitStudent'])->middleware('permission:students.create');
            Route::get('/students/{id}', [StudentController::class, 'show'])->middleware('permission:students.view');
            Route::put('/students/{id}', [StudentController::class, 'update'])->middleware('permission:students.update');
            Route::delete('/students/{id}', [StudentController::class, 'destroy'])->middleware('permission:students.delete');
            Route::post('/students/promote', [StudentController::class, 'promoteStudent'])->middleware('permission:enrollments.create');
            Route::post('/students/transfer', [StudentController::class, 'transferStudent'])->middleware('permission:enrollments.update');

            // THE ABOVE ROUTE STILL NEEDS TESTING

            // Enrollments
            Route::get('/enrollments', [StudentEnrollmentController::class, 'index'])->middleware('permission:enrollments.view');

            Route::post('/enrollments', [StudentEnrollmentController::class, 'store'])->middleware('permission:enrollments.create');

            Route::get('/enrollments/{id}', [StudentEnrollmentController::class, 'show'])->middleware('permission:enrollments.view');

            Route::put('/enrollments/{id}', [StudentEnrollmentController::class, 'update'])->middleware('permission:enrollments.update');

            Route::delete('/enrollments/{id}', [StudentEnrollmentController::class, 'destroy'])->middleware('permission:enrollments.delete');


            // Class Subjects
            Route::get('/class-subjects', [ClassSubjectController::class, 'index'])->middleware('permission:class_subjects.view');

            Route::post('/class-subjects', [ClassSubjectController::class, 'store'])->middleware('permission:class_subjects.create');

            Route::get('/class-subjects/{id}', [ClassSubjectController::class, 'show'])->middleware('permission:class_subjects.view');

            Route::put('/class-subjects/{id}', [ClassSubjectController::class, 'update'])->middleware('permission:class_subjects.update');

            Route::delete('/class-subjects/{id}', [ClassSubjectController::class, 'destroy']) ->middleware('permission:class_subjects.delete');


            // Teacher Assignments
            Route::get('/teacher-assignments', [ClassSubjectTeacherController::class, 'index'])->middleware('permission:teacher_assignments.view');

            Route::post('/teacher-assignments', [ClassSubjectTeacherController::class, 'store'])->middleware('permission:teacher_assignments.create');

            Route::get('/teacher-assignments/{id}', [ClassSubjectTeacherController::class, 'show'])->middleware('permission:teacher_assignments.view');

            Route::put('/teacher-assignments/{id}', [ClassSubjectTeacherController::class, 'update'])->middleware('permission:teacher_assignments.update');

            Route::delete('/teacher-assignments/{id}', [ClassSubjectTeacherController::class, 'destroy'])->middleware('permission:teacher_assignments.delete');

            Route::post('/attendance/mark', [AttendanceController::class,'mark'])->middleware('permission:attendance.mark');
        
            // Results
            Route::get('/results/class-subject/{classSubjectId}/term/{termId}',[ResultController::class, 'resultSheet'])->middleware('permission:results.view');

            Route::post('/results',[ResultController::class, 'store'])->middleware('permission:results.enter');

            Route::get('/results/student/{studentEnrollmentId}/term/{termId}',[ResultController::class, 'studentResults'])->middleware('permission:results.view');

            //busary endpoints

            Route::get('/fee-structures',[FeeStructureController::class, 'index'])->middleware('permission:fees.view');
            Route::post('/fee-structures',[FeeStructureController::class, 'store'])->middleware('permission:fees.create');

            Route::get('/fee-structures/{id}',[FeeStructureController::class, 'show'])->middleware('permission:fees.view');

            Route::put('/fee-structures/{id}',[FeeStructureController::class, 'update'])->middleware('permission:fees.create');

            Route::delete('/fee-structures/{id}',[FeeStructureController::class, 'destroy'])->middleware('permission:fees.create');
            Route::post('/student-fees/assign',[StudentFeeController::class, 'assign'])->middleware('permission:fees.create');

            Route::get('/student-fees/{id}',[StudentFeeController::class, 'show'])->middleware('permission:fees.view');

            Route::get('/students/{studentEnrollmentId}/fees',[StudentFeeController::class, 'studentFees'])->middleware('permission:fees.view');

            Route::post('/payments',[PaymentSubmissionController::class, 'store'])->middleware('permission:payments.create');

            Route::get('/payments/pending',[PaymentSubmissionController::class, 'pending'])->middleware('permission:payments.view');

            Route::patch('/payments/{id}/approve',[PaymentSubmissionController::class, 'approve'])->middleware('permission:payments.create');

            Route::patch('/payments/{id}/reject',[PaymentSubmissionController::class, 'reject'])->middleware('permission:payments.create');

            Route::get('/student-fees/{studentFeeId}/payments',[PaymentSubmissionController::class, 'history'])->middleware('permission:payments.view');

            Route::get('/dashboard',[DashboardController::class, 'index']);

           
        });


                    Route::get('/test', function() {
                return response()->json([
                    'message' => 'WAGWAN CUNTSSSSSSSSSS'
                ]);
            }); 
});