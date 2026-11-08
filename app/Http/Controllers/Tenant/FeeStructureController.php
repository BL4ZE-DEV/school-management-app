<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeStructureRequest;
use App\Services\Tenant\FeeStructureService;

class FeeStructureController extends Controller
{
    public function __construct(
        protected FeeStructureService $service
    ) {}

    public function index()
    {
        return response()->json(
            $this->service->index()
        );
    }

    public function store(StoreFeeStructureRequest $request)
    {
        $feeStructure = $this->service->create(
            $request->validated()
        );

        return response()->json([
            'message' => 'Fee structure created successfully.',
            'data' => $feeStructure,
        ], 201);
    }

    public function show($id)
    {
        return response()->json(
            $this->service->show($id)
        );
    }

    public function update(
        StoreFeeStructureRequest $request,
        $id
    ) {
        return response()->json([
            'message' => 'Fee structure updated successfully.',
            'data' => $this->service->update(
                $id,
                $request->validated()
            ),
        ]);
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json([
            'message' => 'Fee structure deleted successfully.',
        ]);
    }
}