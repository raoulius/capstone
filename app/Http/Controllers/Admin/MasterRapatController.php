<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterRapat;

class MasterRapatController extends Controller
{
    public function index()
    {
        $rapat = MasterRapat::orderBy('tanggal', 'desc')
                           ->orderBy('waktu_mulai', 'asc')
                           ->get();
        
        return view('cms.masterrapat.index', compact('rapat'));
    }

        public function getEvents()
    {
        $events = MasterRapat::all()->map(function($rapat) {
            return [
                'id' => $rapat->id,
                'title' => $rapat->jenis_rapat . ' - ' . $rapat->komisi_type,
                'start' => $rapat->tanggal . 'T' . $rapat->waktu_mulai,
                'end' => $rapat->tanggal . 'T' . $rapat->waktu_selesai,
                'extendedProps' => [
                    'nama' => $rapat->nama,
                    'email' => $rapat->email,
                    'agenda' => $rapat->agenda,
                    'komisi_type' => $rapat->komisi_type
                ]
            ];
        });

        return response()->json($events);
    }

    public function edit($id)
    {
        $rapat = MasterRapat::findOrFail($id);
        return view('cms.masterrapat.edit', compact('rapat'));
    }

    public function update(Request $request, $id)
    {
        $rapat = MasterRapat::findOrFail($id);
        
        $rapat->update([
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return response()->json([
            'message' => 'Rapat updated successfully'
        ]);
    }
}
