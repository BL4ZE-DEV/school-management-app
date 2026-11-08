<?php

namespace App\Models\Tenant;

use Illuminate\Support\Str;

class Student extends TenantModel
{
    protected $fillable = [
        'student_id',
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'dob',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (Student $student) {
            $student->student_id ??= (string) Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(TenantUser::class, 'user_id');
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }
}