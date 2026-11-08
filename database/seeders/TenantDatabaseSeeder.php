<?php

namespace Database\Seeders;

use Database\Seeders\Tenant\AcademicSessionSeeder;
use Database\Seeders\Tenant\AttendanceSeeder;
use Database\Seeders\Tenant\ClassSubjectSeeder;
use Database\Seeders\Tenant\ClassSubjectTeacherSeeder;
use Database\Seeders\Tenant\GradesSeeder;
use Database\Seeders\Tenant\ModuleSeeder;
use Database\Seeders\Tenant\PermissionSeeder;
use Database\Seeders\Tenant\RolePermissionSeeder;
use Database\Seeders\Tenant\RoleSeeder;
use Database\Seeders\Tenant\SchoolClassSeeder;
use Database\Seeders\Tenant\StudentEnrollmentSeeder;
use Database\Seeders\Tenant\StudentsSeeder;
use Database\Seeders\Tenant\SubjectsSeeder;
use Database\Seeders\Tenant\TeachersSeeder;
use Database\Seeders\Tenant\TenantUserSeeder;
use Database\Seeders\Tenant\TermSeeder;
use Database\Seeders\Tenant\UserRoleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ModuleSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            RolePermissionSeeder::class,

            TenantUserSeeder::class,
            UserRoleSeeder::class,

            AcademicSessionSeeder::class,
            TermSeeder::class,
            SchoolClassSeeder::class,
            SubjectsSeeder::class,
            TeachersSeeder::class,
            StudentsSeeder::class,
            StudentEnrollmentSeeder::class,
            ClassSubjectSeeder::class,
            ClassSubjectTeacherSeeder::class,
            GradesSeeder::class,
            AttendanceSeeder::class,
        ]);
    }

}
