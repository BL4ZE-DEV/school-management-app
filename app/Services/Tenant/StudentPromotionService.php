<?php 

namespace App\Services\Tenant;

use App\Models\Tenant\StudentEnrollment;
use Illuminate\Support\Facades\DB;

class StudentPromotionService 
{
    public function promote(array $data)
    {
        return DB::transaction(function() use ($data){
            
            $currentEnrollment = StudentEnrollment::findOrfail($data['current_enrollment_id']);

            $currentEnrollment->update(['status' => 'completed']);

            return StudentEnrollment::create([

                'student_id' => $currentEnrollment->student_id,
                'school_class_id' => $data['new_school_class_id'],
                'academic_session_id' => $data['new_academic_session_id'],
                'enrollment_date' => $data['enrollment_date'],
                'status' => 'active'
            ]);
        });
    }
}