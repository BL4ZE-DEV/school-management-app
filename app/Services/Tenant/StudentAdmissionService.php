<?php

namespace App\Services\Tenant;

use App\Models\Tenant\Role;
use App\Models\Tenant\Student;
use App\Models\Tenant\StudentEnrollment;
use App\Models\Tenant\TenantUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

Class StudentAdmissionService
{
 

   public function admit(array $data)
    {
        return DB::transaction(function () use ($data) {

            $user = TenantUser::create([
                'user_id' => Str::uuid(),
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            $studentRole = Role::where('name', 'Student')->firstOrFail();

            $user->roles()->syncWithoutDetaching([
                $studentRole->id,
            ]);

            $student = Student::create([
                'user_id' => $user->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'gender' => $data['gender'],
                'dob' => $data['dob'],
            ]);

            $enrollment = StudentEnrollment::create([
                'student_id' => $student->id,
                'school_class_id' => $data['school_class_id'],
                'academic_session_id' => $data['academic_session_id'],
                'enrollment_date' => $data['enrollment_date'],
                'status' => 'active',
            ]);

            return [
                'student' => $student->load('user'),
                'enrollment' => $enrollment,
            ];
        });
    }
}