<?php

namespace App\Services\Tenant;

use App\Models\Tenant\StudentEnrollment;

class StudentEnrollmentService
{
    public function index()
    {
        return StudentEnrollment::with([
            'student',
            'schoolClass',
            'academicSession',
        ])->get();
    }

    public function store(array $data)
    {
        return StudentEnrollment::create($data);
    }

    public function show($id)
    {
        return StudentEnrollment::with([
            'student',
            'schoolClass',
            'academicSession',
        ])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $enrollment = StudentEnrollment::findOrFail($id);

        $enrollment->update($data);

        return $enrollment;
    }

    public function destroy($id): bool
    {
        return (bool) StudentEnrollment::findOrFail($id)->delete();
    }
}