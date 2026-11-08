<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;
use App\Services\Tenant\TermService;

class TermController extends Controller
{
    protected $termService;

    public function __construct(TermService $termService)
    {
        $this->termService = $termService;
    }

    public function index()
    {
        $terms = $this->termService->index();

        return response()->json($terms);
    }

    public function store(StoreTermRequest $request)
    {
        $term = $this->termService->store(
            $request->validated()
        );

        return response()->json($term, 201);
    }

    public function show($id)
    {
        $term = $this->termService->show($id);

        return response()->json($term);
    }

    public function update(UpdateTermRequest $request, $id)
    {
        $term = $this->termService->update(
            $id,
            $request->validated()
        );

        return response()->json($term);
    }

    public function destroy($id)
    {
        $this->termService->destroy($id);

        return response()->json([
            'message' => 'Term deleted successfully',
        ]);
    }

    public function activate($id)
    {
        $term = $this->termService->activate($id);

        return response()->json([
            'message' => 'Term activated successfully',
            'term' => $term,
        ]);
    }
}