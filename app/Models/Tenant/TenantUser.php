<?php

namespace App\Models\Tenant;

use App\Models\Tenant\Role;
use App\Models\Tenant\Student;
use App\Models\Tenant\Teacher;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class TenantUser extends Authenticatable implements JWTSubject
{
    protected $connection = 'tenant';

    protected $table = 'tenant_users';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'type' => 'tenant_user',
            'user_id'=> $this->user_id,
            'tenant_id' => app('tenant')->id,
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'user_roles',
            'user_id',
            'role_id',
            'id',
            'id'
        );
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }


    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function hasPermission(string $permission): bool
    {
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($permission){
                $query->where('name', $permission);
            })->exists();
    }
}