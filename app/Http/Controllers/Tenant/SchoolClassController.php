<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use App\Services\Tenant\SchoolClassService;

class SchoolClassController extends Controller
{
    public function __construct(
        protected SchoolClassService $schoolClassService
    ) {}

    public function index()
    {
        return response()->json(
            $this->schoolClassService->index()
        );
    }

    public function store(StoreSchoolClassRequest $request)
    {
        $class = $this->schoolClassService->store(
            $request->validated()
        );

        return response()->json($class, 201);
    }

    public function show($id)
    {
        return response()->json(
            $this->schoolClassService->show($id)
        );
    }

    public function update(UpdateSchoolClassRequest $request, $id)
    {
        $class = $this->schoolClassService->update(
            $id,
            $request->validated()
        );

        return response()->json($class);
    }

    public function destroy($id)
    {
        $this->schoolClassService->destroy($id);

        return response()->json([
            'message' => 'Class deleted successfully',
        ]);
    }
}