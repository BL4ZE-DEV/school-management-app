<?php

namespace App\Services\Tenant;

use App\Models\Tenant\SchoolClass;

class SchoolClassService
{
    public function index()
    {
        return SchoolClass::all();
    }

    public function store(array $data)
    {
        return SchoolClass::create($data);
    }

    public function show($id)
    {
        return SchoolClass::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $class = SchoolClass::findOrFail($id);

        $class->update($data);

        return $class;
    }

    public function destroy($id): bool
    {
        return (bool) SchoolClass::findOrFail($id)->delete();
    }
}