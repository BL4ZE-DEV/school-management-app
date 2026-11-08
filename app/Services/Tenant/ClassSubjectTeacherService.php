<?php

namespace App\Services\Tenant;

use App\Models\Tenant\ClassSubjectTeacher;

class ClassSubjectTeacherService
{
    public function index()
    {
        return ClassSubjectTeacher::with([
            'classSubject.schoolClass',
            'classSubject.subject',
            'teacher',
            'term',
        ])->get();
    }

    public function store(array $data)
    {
        return ClassSubjectTeacher::create($data);
    }

    public function show($id)
    {
        return ClassSubjectTeacher::with([
            'classSubject',
            'teacher',
            'term',
        ])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $assignment = ClassSubjectTeacher::findOrFail($id);

        $assignment->update($data);

        return $assignment;
    }

    public function destroy($id): bool
    {
        return (bool) ClassSubjectTeacher::findOrFail($id)->delete();
    }
}