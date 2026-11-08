<?php

namespace App\Models\Tenant;

class ClassSubjectTeacher extends TenantModel
{
    protected $fillable = [
        'class_subject_id',
        'teacher_id',
        'term_id',
    ];

    public function classSubject()
    {
        return $this->belongsTo(ClassSubject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}