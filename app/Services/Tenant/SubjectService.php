<?php

namespace App\Services\Tenant;

use App\Models\Tenant\Subject;

class SubjectService
{
    public function index()
    {
        return Subject::all();
    }

    public function store(array $data)
    {
        return Subject::create($data);
    }

    public function show($id)
    {
        return Subject::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $subject = Subject::findOrFail($id);

        $subject->update($data);

        return $subject;
    }

    public function destroy($id): bool
    {
        return (bool) Subject::findOrFail($id)->delete();
    }
}