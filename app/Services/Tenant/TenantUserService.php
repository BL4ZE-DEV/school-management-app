<?php


namespace App\Services\Tenant;

use App\Models\Tenant\TenantUser;

class TenantUserService
{
    public function creatTenantuser(array $data)
    {
        $tenant= TenantUser::create($data);

        if($data['role'] === 'teacher'){
            //Shii to create a teacher profile
            
        }


        return $tenant;
    }

}