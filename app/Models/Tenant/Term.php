<?php

namespace App\Models\Tenant;

class Term extends TenantModel
{
    protected $fillable = [
        'academic_session_id',
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

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function classSubjectTeachers()
    {
        return $this->hasMany(ClassSubjectTeacher::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}