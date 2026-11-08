<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdmitStudentRequest;
use App\Http\Requests\PromoteStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\TransferStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Services\Tenant\StudentAdmissionService;
use App\Services\Tenant\StudentPromotionService;
use App\Services\Tenant\StudentService;
use App\Services\Tenant\StudentTransferService;

class StudentController extends Controller
{
    public function __construct(
        protected StudentService $studentService,
        protected StudentAdmissionService $studentAdmissionService,
        protected StudentPromotionService $studentPromotionService,
        protected StudentTransferService $studentTransferService

    ) {}

    public function index()
    {
        return response()->json(
            $this->studentService->index()
        );
    }

    public function show($id)
    {
        return response()->json(
            $this->studentService->show($id)
        );
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $student = $this->studentService->update(
            $id,
            $request->validated()
        );

        return response()->json($student);
    }

    public function destroy($id)
    {
        $this->studentService->destroy($id);

        return response()->json([
            'message' => 'Student deleted successfully',
        ]);
    }

    public function admitStudent(AdmitStudentRequest $request)
    {
       $result =  $this->studentAdmissionService->admit($request->validated());

       return response()->json([
            'Message' => 'Student Addmitted Successfully',
            'data' => $result
       ],201);
    }

    public function promoteStudent(PromoteStudentRequest $request)
    {
        $result = $this->studentPromotionService->promote($request->validated());

        return response()->json([
            'Message' => 'Student Promoted Successfully',
            'data' => $result
        ],201);
    }

    public function transferStudent(TransferStudentRequest $request)
    {
        $result = $this->studentTransferService->transfer($request->validated());

        return response()->json([
            'Message' => 'Successful',
            'Data' => $result
        ]);
    }
}