<?php


namespace App\Services\Tenant;

use App\Models\Tenant\StudentEnrollment;
use Illuminate\Support\Facades\DB;

class StudentTransferService
{
    public function Transfer(array $data){

        return DB::transaction(function() use ($data){

            $enrollment = StudentEnrollment::findOrfail($data['current_enrollment_id']);


            $enrollment->update(['school_class_id' => $data['new_school_class_id']]);

            return $enrollment->fresh([
                'student',
                'schoolClass',
                'academicSession',
            ]);
            
        });
    }
}