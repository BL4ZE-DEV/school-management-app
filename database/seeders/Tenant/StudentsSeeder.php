<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Role;
use App\Models\Tenant\Student;
use App\Models\Tenant\TenantUser;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    public function run(): void
    {
        $studentRole = Role::where('name', 'Student')->firstOrFail();

        $students = [
            [
                'first_name' => 'David',
                'last_name' => 'Adebayo',
                'email' => 'david.adebayo@ilead.test',
                'gender' => 'Male',
                'dob' => '2012-04-15',
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Okon',
                'email' => 'sarah.okon@ilead.test',
                'gender' => 'Female',
                'dob' => '2011-09-21',
            ],
        ];

        foreach ($students as $studentData) {

            $user = TenantUser::updateOrCreate(
                [
                    'email' => $studentData['email'],
                ],
                [
                    'first_name' => $studentData['first_name'],
                    'last_name' => $studentData['last_name'],
                    'password' => 'password',
                    'user_id' => \Illuminate\Support\Str::uuid(),
                ]
            );

            Student::updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'first_name' => $studentData['first_name'],
                    'last_name' => $studentData['last_name'],
                    'gender' => $studentData['gender'],
                    'dob' => $studentData['dob'],
                ]
            );

            $user->roles()->syncWithoutDetaching([
                $studentRole->id,
            ]);
        }
    }
}