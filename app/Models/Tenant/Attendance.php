<?php

namespace App\Models\Tenant;

class Attendance extends TenantModel
{
    protected $table = 'attendance';

    protected $fillable = [
        'student_enrollment_id',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function studentEnrollment()
    {
        return $this->belongsTo(StudentEnrollment::class);
    }
}