<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Module;
use App\Models\Tenant\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'Administration' => [
                'users.view',
                'users.create',
                'users.update',
                'users.delete',
            ],

            'Academics' => [
                'academic_sessions.view',
                'academic_sessions.create',
                'academic_sessions.update',
                'academic_sessions.delete',
                'academic_sessions.activate',
                
                'subjects.view',
                'subjects.create',
                'subjects.update',
                'subjects.delete',

                'attendance.view',
                'attendance.mark',

                'results.view',
                'results.enter',

                'terms.view',
                'terms.create',
                'terms.update',
                'terms.delete',

                'classes.view',
                'classes.create',
                'classes.update',
                'classes.delete',

                'subjects.view',
                'subjects.create',
                'subjects.update',
                'subjects.delete',

                'teachers.view',
                'teachers.create',
                'teachers.update',
                'teachers.delete',

                'students.view',
                'students.create',
                'students.update',
                'students.delete',

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
            ],

            'Bursary' => [
                'fees.view',
                'fees.create',

                'payments.view',
                'payments.create',
            ],

            'Student Portal' => [
                'student.profile.view',
                'student.results.view',
                'student.attendance.view',
            ],
        ];

        foreach ($permissions as $moduleName => $permissionNames) {

            $module = Module::where('name', $moduleName)->first();
            
            foreach ($permissionNames as $permissionName) {
                Permission::updateOrCreate(
                    [
                        'name' => $permissionName,
                    ],
                    [
                        'module_id' => $module->id,
                    ]
                );
            }
        }
    }
}