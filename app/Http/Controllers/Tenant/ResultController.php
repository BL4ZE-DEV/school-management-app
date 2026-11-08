<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResultsRequest;
use App\Services\Tenant\ResultService;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(
        protected ResultService $resultService
    ) {}

    public function resultSheet(
        $classSubjectId,
        $termId
    ) {
        $result = $this->resultService->getResultSheet(
            $classSubjectId,
            $termId
        );

        return response()->json($result);
    }

    public function store(StoreResultsRequest $request)
    {
        $grades = $this->resultService->saveResults(
            $request->validated()
        );

        return response()->json([
            'message' => 'Results saved successfully',
            'grades' => $grades,
        ]);
    }

    public function studentResults(
        $studentEnrollmentId,
        $termId
    ) {
        $results = $this->resultService->getStudentResults(
            $studentEnrollmentId,
            $termId
        );

        return response()->json([
            'results' => $results,
        ]);
    }
}