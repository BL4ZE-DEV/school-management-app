<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassSubjectTeacherRequest;
use App\Http\Requests\UpdateClassSubjectTeacherRequest;
use App\Services\Tenant\ClassSubjectTeacherService;

class ClassSubjectTeacherController extends Controller
{
    public function __construct(
        protected ClassSubjectTeacherService $classSubjectTeacherService
    ) {}

    public function index()
    {
        return response()->json(
            $this->classSubjectTeacherService->index()
        );
    }

    public function store(StoreClassSubjectTeacherRequest $request)
    {
        $assignment = $this->classSubjectTeacherService->store(
            $request->validated()
        );

        return response()->json($assignment, 201);
    }

    public function show($id)
    {
        return response()->json(
            $this->classSubjectTeacherService->show($id)
        );
    }

    public function update(UpdateClassSubjectTeacherRequest $request, $id)
    {
        $assignment = $this->classSubjectTeacherService->update(
            $id,
            $request->validated()
        );

        return response()->json($assignment);
    }

    public function destroy($id)
    {
        $this->classSubjectTeacherService->destroy($id);

        return response()->json([
            'message' => 'Teacher assignment deleted successfully',
        ]);
    }
}