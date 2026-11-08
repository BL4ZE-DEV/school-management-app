<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Role;
use App\Models\Tenant\Teacher;
use App\Models\Tenant\TenantUser;
use Illuminate\Database\Seeder;

class TeachersSeeder extends Seeder
{
    public function run(): void
    {
        $teacherRole = Role::where('name', 'Teacher')->firstOrFail();

        $teachers = [
            [
                'first_name' => 'John',
                'last_name' => 'Ade',
                'email' => 'john.ade@ilead.test',
                'phone' => '08030000001',
            ],
            [
                'first_name' => 'Mary',
                'last_name' => 'Okafor',
                'email' => 'mary.okafor@ilead.test',
                'phone' => '08030000002',
            ],
        ];

        foreach ($teachers as $teacherData) {

            $user = TenantUser::updateOrCreate(
                [
                    'email' => $teacherData['email'],
                ],
                [
                    'user_id' => \Illuminate\Support\Str::uuid(),
                    'first_name' => $teacherData['first_name'],
                    'last_name' => $teacherData['last_name'],
                    'password' => 'password',
                    'phone' => $teacherData['phone'],
                ]
            );

            Teacher::updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'first_name' => $teacherData['first_name'],
                    'last_name' => $teacherData['last_name'],
                    'phone' => $teacherData['phone'],
                ]
            );

            $user->roles()->syncWithoutDetaching([
                $teacherRole->id,
            ]);
        }
    }
}