<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassSubjectRequest;
use App\Http\Requests\UpdateClassSubjectRequest;
use App\Services\Tenant\ClassSubjectService;

class ClassSubjectController extends Controller
{
    public function __construct(
        protected ClassSubjectService $classSubjectService
    ) {}

    public function index()
    {
        return response()->json(
            $this->classSubjectService->index()
        );
    }

    public function store(StoreClassSubjectRequest $request)
    {
        $classSubject = $this->classSubjectService->store(
            $request->validated()
        );

        return response()->json($classSubject, 201);
    }

    public function show($id)
    {
        return response()->json(
            $this->classSubjectService->show($id)
        );
    }

    public function update(UpdateClassSubjectRequest $request, $id)
    {
        $classSubject = $this->classSubjectService->update(
            $id,
            $request->validated()
        );

        return response()->json($classSubject);
    }

    public function destroy($id)
    {
        $this->classSubjectService->destroy($id);

        return response()->json([
            'message' => 'Class subject deleted successfully',
        ]);
    }
}