<?php

namespace App\Services\Tenant;

use App\Models\Tenant\ClassSubject;

class ClassSubjectService
{
    public function index()
    {
        return ClassSubject::with([
            'schoolClass',
            'subject',
            'academicSession',
        ])->get();
    }

    public function store(array $data)
    {
        return ClassSubject::create($data);
    }

    public function show($id)
    {
        return ClassSubject::with([
            'schoolClass',
            'subject',
            'academicSession',
        ])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $classSubject = ClassSubject::findOrFail($id);

        $classSubject->update($data);

        return $classSubject;
    }

    public function destroy($id): bool
    {
        return (bool) ClassSubject::findOrFail($id)->delete();
    }
}