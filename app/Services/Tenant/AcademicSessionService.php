<?php

namespace App\Services\Tenant;

use App\Models\Tenant\AcademicSession;
use Illuminate\Support\Facades\DB;

Class AcademicSessionService
{
    public function index()
    {
        $sessions = AcademicSession::all();

        return $sessions;
    }

    public function createSession($data)
    {
        $session = AcademicSession::create([
            'name' => $data['name'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        return $session;
    }

    public function updateSession($id, $data)
    {
        $session = AcademicSession::findOrFail($id);

        $session->update([
            'name' => $data['name'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        return $session;
    }

    public function deleteSession($id)
    {
        $session = AcademicSession::findOrFail($id);
        
        return (bool) $session->delete();
    }

    public function getSession($id)
    {
        $session = AcademicSession::findOrFail($id);

        return $session;
    }

    public function getCurrentSession()
    {
        return AcademicSession::where('is_active', true)->first();
    }

    public function activateSession($id)
    {
        return DB::transaction(function () use ($id){
                
                $session = AcademicSession::findOrfail($id);

                AcademicSession::where('is_active', true)->update(['is_active' => false]);

                $session = AcademicSession::findOrFail($id);
                $session->is_active = true;
                $session->save();

                return $session;

        });
    }

}