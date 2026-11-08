<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcademicSessionRequest;
use App\Http\Requests\UpdateAcademicSessionRequest;
use App\Services\Tenant\AcademicSessionService;

class AcademicSessionController extends Controller
{
    protected $academicSessionService;

    public function __construct(AcademicSessionService $academicSessionService)
    {
        $this->academicSessionService = $academicSessionService;
    }

    public function index()
    {
        $sessions = $this->academicSessionService->index();

        return response()->json([
            'sessions' => $sessions,
        ]);
    }

    public function store(StoreAcademicSessionRequest $request)
    {
        $session = $this->academicSessionService->createSession($request->validated());

        return response()->json([
            'message' => 'Academic session created successfully',
            'session' => $session,
        ], 201);
    }

    public function show($id)
    {
        $session = $this->academicSessionService->getSession($id);

        return response()->json([
            'session' => $session,
        ]);
    }

    public function update(UpdateAcademicSessionRequest $request,$id) 
    {
        $session = $this->academicSessionService->updateSession($id,$request->validated());

        return response()->json([
            'message' => 'Academic session updated successfully',
            'session' => $session,
        ]);
    }

    public function delete($id)
    {
        $this->academicSessionService->deleteSession($id);

        return response()->json([
            'message' => 'Academic session deleted successfully',
        ]);
    }

    public function getCurrentSession()
    {
        $session = $this->academicSessionService->getCurrentSession();

        if (!$session){
            return response()->json([
                'message' => 'No active academic session found',
            ], 404);
        }

        return response()->json([
            'session' => $session,
        ]);
    }

    public function activateSession($id)
    {
        $session = $this->academicSessionService->activateSession($id);

        return response()->json([
            'message' => 'Academic session activated successfully',
            'session' => $session,
        ]);
    }
}