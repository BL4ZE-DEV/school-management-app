<?php

namespace App\Models\Tenant;

class ClassSubject extends TenantModel
{
    protected $fillable = [
        'class_id',
        'subject_id',
        'academic_session_id',
    ];

    public function schoolClass()
    {
        return $this->belongsTo(
            SchoolClass::class,
            'class_id'
        );
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function teacherAssignments()
    {
        return $this->hasMany(ClassSubjectTeacher::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}