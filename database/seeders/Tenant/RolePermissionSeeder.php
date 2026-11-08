<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Permission;
use App\Models\Tenant\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $rolePermissions = [

            'Tenant Admin' => [

                'users.view',
                'users.create',
                'users.update',
                'users.delete',

                'students.view',
                'students.create',
                'students.update',
                'students.delete',

                'teachers.view',
                'teachers.create',
                'teachers.update',
                'teachers.delete',

                'classes.view',
                'classes.create',
                'classes.update',
                'classes.delete',

                'subjects.view',
                'subjects.create',
                'subjects.update',
                'subjects.delete',

                'attendance.view',
                'attendance.mark',

                'results.view',
                'results.enter',

                'fees.view',
                'fees.create',

                'payments.view',
                'payments.create',

                'profile.view',
                
                'academic_sessions.view',
                'academic_sessions.create',
                'academic_sessions.update',
                'academic_sessions.delete',
                'academic_sessions.activate',
                'terms.view',
                'terms.create',
                'terms.update',
                'terms.delete',
            ],

            'Principal' => [
                'users.view',

                'students.view',
                'students.create',
                'students.update',

                'teachers.view',
                'teachers.create',
                'teachers.update',

                'classes.view',
                'classes.create',
                'classes.update',

                'subjects.view',
                'subjects.create',
                'subjects.update',

                'attendance.view',
                'attendance.mark',

                'results.view',
                'results.enter',

                'fees.view',
                'payments.view',

                'academic_sessions.view',
                'academic_sessions.create',
                'academic_sessions.update',
                'academic_sessions.delete',
                'academic_sessions.activate',
                
                'enrollments.view',
                'enrollments.create',
                'enrollments.update',
                'enrollments.delete',

                'class_subjects.view',
                'class_subjects.create',
                'class_subjects.update',
                'class_subjects.delete',

                'teacher_assignments.view',
                'teacher_assignments.create',
                'teacher_assignments.update',
                'teacher_assignments.delete',
                 'terms.view',
                'terms.create',
                'terms.update',
                'terms.delete',

            ],

            'Vice Principal' => [
                'users.view',

                'students.view',
                'students.update',

                'teachers.view',

                'classes.view',

                'subjects.view',

                'attendance.view',
                'attendance.mark',

                'results.view',
                'results.enter',

                'academic_sessions.view',
                'academic_sessions.activate',
                'academic_sessions.update',


                'enrollments.view',
                'enrollments.create',
                'enrollments.update',

                'class_subjects.view',
                'class_subjects.create',
                'class_subjects.update',

                'teacher_assignments.view',
                'teacher_assignments.create',
                'teacher_assignments.update',

                'terms.view',
                'terms.create',
                'terms.update',
            ],

            'Teacher' => [
                'students.view',

                'teachers.view',

                'classes.view',

                'subjects.view',

                'attendance.view',
                'attendance.mark',

                'results.view',
                'results.enter',

                'profile.view',

                'academic_sessions.view',

                'terms.view',
                'enrollments.view',
                'class_subjects.view',
                'teacher_assignments.view',



            ],

            'Bursar' => [
                'students.view',
                'enrollments.view',
                'fees.view',
                'fees.create',
                

                'payments.view',
                'payments.create',

                'profile.view',

                'academic_sessions.view',

            ],

            'Student' => [
                'student.profile.view',
                'student.results.view',
                'student.attendance.view',
                'academic_sessions.view',
                'terms.view',
                'classes.view',
                'subjects.view'


            ],
        ];

        foreach ($rolePermissions as $roleName => $permissionNames) {

            $role = Role::where('name', $roleName)->firstOrFail();

            if ($roleName === 'Tenant Admin') {
                $permissions = Permission::all();
            } else {
                $permissions = Permission::whereIn(
                    'name',
                    $permissionNames
                )->get();
            }

            $role->permissions()->sync($permissions);
        }
    }
}