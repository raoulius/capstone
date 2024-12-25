<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BadanLegislasiRapat;

class BadanLegislasiRapatController extends Controller
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
        return view('cms.buatrapat.badanlegislasi');
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
        $badan_legislasi_rapat = new BadanLegislasiRapat();
        $badan_legislasi_rapat->nama = $request->input('nama');
        $badan_legislasi_rapat->email = $request->input('email');
        $badan_legislasi_rapat->tanggal = $request->input('tanggal');
        $badan_legislasi_rapat->waktu_mulai = $request->input('waktu_mulai');
        $badan_legislasi_rapat->waktu_selesai = $request->input('waktu_selesai');
        $badan_legislasi_rapat->jenis_rapat = $request->input('jenis_rapat');
        $badan_legislasi_rapat->agenda = $request->input('agenda');

        // Save the Rapat record to the database
        $badan_legislasi_rapat->save();

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('admin.buatrapat.badanlegislasicreate')->with('success', 'Rapat berhasil dibuat!');
    }
}   

