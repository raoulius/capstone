<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRecord;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rapat_id' => 'required|exists:master_rapat,id',
            'nama' => 'required|string',
            'email' => 'required|email',
            'waktu_absen' => 'required|date',
            'komisi_type' => 'required|string'
        ]);

        $attendance = AttendanceRecord::create($request->all());

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