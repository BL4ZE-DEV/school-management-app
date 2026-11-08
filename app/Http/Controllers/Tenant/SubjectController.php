<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Services\Tenant\SubjectService;

class SubjectController extends Controller
{
    public function __construct(
        protected SubjectService $subjectService
    ) {}

    public function index()
    {
        return response()->json(
            $this->subjectService->index()
        );
    }

    public function store(StoreSubjectRequest $request)
    {
        $subject = $this->subjectService->store(
            $request->validated()
        );

        return response()->json($subject, 201);
    }

    public function show($id)
    {
        return response()->json(
            $this->subjectService->show($id)
        );
    }

    public function update(UpdateSubjectRequest $request, $id)
    {
        $subject = $this->subjectService->update(
            $id,
            $request->validated()
        );

        return response()->json($subject);
    }

    public function destroy($id)
    {
        $this->subjectService->destroy($id);

        return response()->json([
            'message' => 'Subject deleted successfully',
        ]);
    }
}