<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignStudentFeeRequest;
use App\Services\Tenant\StudentFeeService;

class StudentFeeController extends Controller
{
    public function __construct(
        protected StudentFeeService $service
    ) {}

    public function assign(AssignStudentFeeRequest $request)
    {
        $data = $request->validated();

        $studentFee = $this->service->assignFee(
            $data['student_enrollment_id'],
            $data['fee_structure_id']
        );

        return response()->json([
            'message' => 'Fee assigned successfully.',
            'data' => $studentFee,
        ], 201);
    }

    public function show($id)
    {
        return response()->json(
            $this->service->show($id)
        );
    }

    public function studentFees($studentEnrollmentId)
    {
        return response()->json(
            $this->service->studentFees(
                $studentEnrollmentId
            )
        );
    }
}