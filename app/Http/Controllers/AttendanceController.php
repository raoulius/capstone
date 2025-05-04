<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'rapat_id' => 'required|exists:master_rapat,id',
            'nama' => 'required|string',
            'email' => 'required|email',
            'waktu_absen' => 'required|date',
            'komisi_type' => 'required|string'
        ]);

        $data = $request->all();
        $data['waktu_absen'] = \Carbon\Carbon::parse($request->waktu_absen)->format('Y-m-d H:i:s');

        $attendance = AttendanceRecord::create($data);

        Log::info('Attendance Store', ['attendance' => $request->all()]);

        return response()->json($attendance, 201);
    }

    public function getAttendanceForRapat($rapatId)
    {
        $attendance = AttendanceRecord::where('rapat_id', $rapatId)
            ->orderBy('waktu_absen', 'desc')
            ->get();

        return response()->json($attendance);
    }
}