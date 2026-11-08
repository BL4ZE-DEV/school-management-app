<?php

namespace App\Services\Tenant;

use App\Models\Tenant\Role;
use App\Models\Tenant\Teacher;
use App\Models\Tenant\TenantUser;
use Illuminate\Support\Facades\DB;

class TeacherService
{
    public function index()
    {
        return Teacher::with('user')->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $user = TenantUser::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'phone' => $data['phone'] ?? null,
            ]);

            $role = Role::where('name', 'Teacher')->firstOrFail();

            $user->roles()->syncWithoutDetaching([
                $role->id,
            ]);

            $teacher = Teacher::create([
                'user_id' => $user->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'] ?? null,
            ]);

            return $teacher->load('user');
        });
    }

    public function show($id)
    {
        return Teacher::with('user')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $teacher = Teacher::findOrFail($id);

        $teacher->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'] ?? null,
        ]);

        return $teacher;
    }

    public function destroy($id): bool
    {
        return (bool) Teacher::findOrFail($id)->delete();
    }
}