<?php

namespace App\Models\Tenant;

class SchoolClass extends TenantModel
{
    protected $fillable = [
        'name',
        'level',
    ];

    public function studentEnrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }

    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'class_id');
    }
}