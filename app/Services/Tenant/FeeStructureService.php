<?php

namespace App\Services\Tenant;

use App\Models\Tenant\FeeStructure;

class FeeStructureService
{
    public function index()
    {
        return FeeStructure::with([
            'academicSession',
            'schoolClass',
            'term',
        ])->get();
    }

    public function create(array $data)
    {
        return FeeStructure::create($data);
    }

    public function show(int $id)
    {
        return FeeStructure::with([
            'academicSession',
            'schoolClass',
            'term',
        ])->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $feeStructure = FeeStructure::findOrFail($id);

        $feeStructure->update($data);

        return $feeStructure->fresh();
    }

    public function delete(int $id): bool
    {
        return (bool) FeeStructure::findOrFail($id)->delete();
    }
}