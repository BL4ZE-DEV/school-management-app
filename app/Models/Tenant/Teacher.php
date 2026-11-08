<?php

namespace App\Models\Tenant;

use Illuminate\Support\Str;

class Teacher extends TenantModel
{
    protected $fillable = [
        'teacher_id',
        'user_id',
        'first_name',
        'last_name',
        'phone',
    ];

    protected static function booted(): void
    {
        static::creating(function (Teacher $teacher) {
            $teacher->teacher_id ??= (string) Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(TenantUser::class, 'user_id');
    }

    public function classSubjectTeachers()
    {
        return $this->hasMany(ClassSubjectTeacher::class);
    }
}