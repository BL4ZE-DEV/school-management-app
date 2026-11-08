<?php

namespace App\Models\Tenant;

class Subject extends TenantModel
{
    protected $fillable = [
        'name',
        'code',
    ];

    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class);
    }
}