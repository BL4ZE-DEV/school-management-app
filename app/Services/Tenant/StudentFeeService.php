<?php

namespace App\Services\Tenant;

use App\Models\Tenant\FeeStructure;
use App\Models\Tenant\StudentEnrollment;
use App\Models\Tenant\StudentFee;

class StudentFeeService
{
    public function assignFee(int $studentEnrollmentId,int $feeStructureId) {
        $enrollment = StudentEnrollment::findOrFail($studentEnrollmentId);

        $feeStructure = FeeStructure::findOrFail($feeStructureId);

        /*
        Make sure the fee structure actually belongs
        to the student's class/session.
        */

        if ($enrollment->school_class_id !== $feeStructure->school_class_id||$enrollment->academic_session_id !== $feeStructure->academic_session_id) 

            
        {throw new \Exception('This fee structure does not belong to the student class or academic session.');}

        return StudentFee::firstOrCreate(
            [
                'student_enrollment_id' => $enrollment->id,
                'fee_structure_id' => $feeStructure->id,
            ],
            [
                'amount_due' => $feeStructure->amount,
            ]
        );
    }

    public function show(int $id)
    {
        return StudentFee::with([
            'studentEnrollment.student.user',
            'studentEnrollment.schoolClass',
            'studentEnrollment.academicSession',
            'feeStructure.term',
            'paymentSubmissions',
        ])->findOrFail($id);
    }

    public function studentFees(int $studentEnrollmentId)
    {
        return StudentFee::with([
            'feeStructure',
            'feeStructure.term',
            'paymentSubmissions',
        ])
        ->where(
            'student_enrollment_id',
            $studentEnrollmentId
        )
        ->get();
    }
}