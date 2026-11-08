<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    /** @use HasFactory<\Database\Factories\TenantFactory> */
    use HasFactory;

    protected $fillable = [
        'tenantId',
        'school_name',
        'location',
        'subdomain',
        'database',
        'status'
    ];

    protected $hidden = [
        'id'
    ];


    public static function booted(){
        static::creating(function($tenant){
            $tenant->tenantId = (string) \Illuminate\Support\Str::uuid();
        });
    }
}

