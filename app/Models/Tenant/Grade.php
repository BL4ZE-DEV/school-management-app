<?php

namespace App\Models\Tenant;

class Grade extends TenantModel
{
    protected $fillable = [
        'student_enrollment_id',
        'class_subject_id',
        'term_id',
        'ca_score',
        'exam_score',
    ];

    protected $casts = [
        'ca_score' => 'integer',
        'exam_score' => 'integer',
    ];

    public function studentEnrollment()
    {
        return $this->belongsTo(StudentEnrollment::class);
    }

    public function classSubject()
    {
        return $this->belongsTo(ClassSubject::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function getTotalScoreAttribute()
    {
        return $this->ca_score + $this->exam_score;
    }
}