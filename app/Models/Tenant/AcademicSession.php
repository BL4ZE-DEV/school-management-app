<?php

namespace App\Models\Tenant;

class AcademicSession extends TenantModel
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    public function studentEnrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }

    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class);
    }
}