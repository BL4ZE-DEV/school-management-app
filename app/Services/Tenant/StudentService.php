<?php

namespace App\Services\Tenant;


use App\Models\Tenant\Student;

class StudentService
{
    public function index()
    {
        return Student::with('user')->get();
    }

    public function show($id)
    {
        return Student::with([
            'user',
            'enrollments.schoolClass',
            'enrollments.academicSession',
        ])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $student = Student::findOrFail($id);

        $student->update($data);

        return $student;
    }

    public function destroy($id): bool
    {
        return (bool) Student::findOrFail($id)->delete();
    }
}