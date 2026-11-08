<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentEnrollmentRequest;
use App\Http\Requests\UpdateStudentEnrollmentRequest;
use App\Services\Tenant\StudentEnrollmentService;

class StudentEnrollmentController extends Controller
{
    public function __construct(
        protected StudentEnrollmentService $studentEnrollmentService
    ) {}

    public function index()
    {
        return response()->json(
            $this->studentEnrollmentService->index()
        );
    }

    public function store(StoreStudentEnrollmentRequest $request)
    {
        $enrollment = $this->studentEnrollmentService->store(
            $request->validated()
        );

        return response()->json($enrollment, 201);
    }

    public function show($id)
    {
        return response()->json(
            $this->studentEnrollmentService->show($id)
        );
    }

    public function update(UpdateStudentEnrollmentRequest $request, $id)
    {
        $enrollment = $this->studentEnrollmentService->update(
            $id,
            $request->validated()
        );

        return response()->json($enrollment);
    }

    public function destroy($id)
    {
        $this->studentEnrollmentService->destroy($id);

        return response()->json([
            'message' => 'Enrollment deleted successfully',
        ]);
    }
}