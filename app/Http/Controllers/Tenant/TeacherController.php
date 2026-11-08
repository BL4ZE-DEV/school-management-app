<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Services\Tenant\TeacherService;

class TeacherController extends Controller
{
    public function __construct(
        protected TeacherService $teacherService
    ) {}

    public function index()
    {
        return response()->json(
            $this->teacherService->index()
        );
    }

    public function store(StoreTeacherRequest $request)
    {
        $teacher = $this->teacherService->store(
            $request->validated()
        );

        return response()->json($teacher, 201);
    }

    public function show($id)
    {
        return response()->json(
            $this->teacherService->show($id)
        );
    }

    public function update(UpdateTeacherRequest $request, $id)
    {
        $teacher = $this->teacherService->update(
            $id,
            $request->validated()
        );

        return response()->json($teacher);
    }

    public function destroy($id)
    {
        $this->teacherService->destroy($id);

        return response()->json([
            'message' => 'Teacher deleted successfully',
        ]);
    }
}