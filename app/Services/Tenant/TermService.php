<?php

namespace App\Services\Tenant;

use App\Models\Tenant\Term;
use Illuminate\Support\Facades\DB;

class TermService
{
    public function index()
    {
        return Term::with('academicSession')->get();
    }

    public function store(array $data)
    {
        return Term::create($data);
    }

    public function show($id)
    {
        return Term::with('academicSession')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $term = Term::findOrFail($id);

        $term->update($data);

        return $term;
    }

    public function destroy($id): bool
    {
        $term = Term::findOrFail($id);

        return (bool) $term->delete();
    }

    public function activate($id)
    {
        return DB::transaction(function () use ($id) {

            $term = Term::findOrFail($id);

            Term::where('academic_session_id', $term->academic_session_id)
                ->where('is_active', true)
                ->update([
                    'is_active' => false,
                ]);

            $term->update([
                'is_active' => true,
            ]);

            return $term;
        });
    }
}