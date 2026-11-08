<?php

namespace App\Models\Tenant;

class StudentEnrollment extends TenantModel
{
    protected $fillable = [
        'student_id',
        'school_class_id',
        'academic_session_id',
        'enrollment_date',
        'status',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(
            SchoolClass::class,
            'school_class_id'
        );
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}