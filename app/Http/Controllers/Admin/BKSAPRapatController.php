<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BKSAPRapat;

class BKSAPRapatController extends Controller
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
        return view('cms.buatrapat.bksap');
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
        $bksap_rapat = new BKSAPRapat();
        $bksap_rapat->nama = $request->input('nama');
        $bksap_rapat->email = $request->input('email');
        $bksap_rapat->tanggal = $request->input('tanggal');
        $bksap_rapat->waktu_mulai = $request->input('waktu_mulai');
        $bksap_rapat->waktu_selesai = $request->input('waktu_selesai');
        $bksap_rapat->jenis_rapat = $request->input('jenis_rapat');
        $bksap_rapat->agenda = $request->input('agenda');

        // Save the Rapat record to the database
        $bksap_rapat->save();

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('admin.buatrapat.bksapcreate')->with('success', 'Rapat berhasil dibuat!');
    }
}   


