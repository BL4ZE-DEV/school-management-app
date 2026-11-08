<?php

namespace App\Models\Tenant;


class FeeStructure extends TenantModel
{
    protected $fillable = [
        'academic_session_id',
        'school_class_id',
        'term_id',
        'amount',
        'description',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function studentFees()
    {
        return $this->hasMany(StudentFee::class);
    }
}