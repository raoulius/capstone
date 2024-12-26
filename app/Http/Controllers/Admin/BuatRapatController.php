<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuatRapat; // Assuming you have a Rapat model for this
use App\Models\MasterRapat;

    class BuatRapatController extends Controller
{
    /**
     * Show the index page for Rapat.
     */
    public function index()
    {
        return view('cms.buatrapat.index');
    }

    /**
     * Show the form for creating a new Rapat.
     */
    public function create()
    {
        return view('cms.buatrapat.create');
    }

    /**
     * Store a newly created Rapat in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'jenis_rapat' => 'required|string|max:255',
            'agenda' => 'required|string',
        ]);

        // Create a new Rapat record
        $rapat = new BuatRapat();
        $rapat->nama = $request->input('nama');
        $rapat->email = $request->input('email');
        $rapat->tanggal = $request->input('tanggal');
        $rapat->waktu_mulai = $request->input('waktu_mulai');
        $rapat->waktu_selesai = $request->input('waktu_selesai');
        $rapat->jenis_rapat = $request->input('jenis_rapat');
        $rapat->agenda = $request->input('agenda');

        // Save the Rapat record to the database
        $rapat->save();

        MasterRapat::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'tanggal' => $request->input('tanggal'),
            'waktu_mulai' => $request->input('waktu_mulai'),
            'waktu_selesai' => $request->input('waktu_selesai'),
            'jenis_rapat' => $request->input('jenis_rapat'),
            'agenda' => $request->input('agenda'),
            'komisi_type' => 'Komisi 1',
            'original_id' => $rapat->id
        ]);

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('admin.buatrapat.create')->with('success', 'Rapat berhasil dibuat!');
    }
}   
