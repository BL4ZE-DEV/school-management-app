<?php

namespace App\Models\Tenant;

class Module extends TenantModel
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}