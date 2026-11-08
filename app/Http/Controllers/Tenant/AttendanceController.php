<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarkAttendanceRequest;
use App\Services\Tenant\AttendanceService;

class AttendanceController extends Controller
{

    public function __construct(
        protected AttendanceService $attendanceService
    ) {}

    public function mark(MarkAttendanceRequest $request)
    {
        $this->attendanceService->markAttendance(
            $request->validated()
        );

        return response()->json([
            'message' => 'Attendance recorded successfully',
        ]);
    }

}
