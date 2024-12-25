<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BadanKehormatanRapat;

class BadanKehormatanRapatController extends Controller
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
        return view('cms.buatrapat.badankehormatan');
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
        $badan_kehormatan_rapat = new BadanKehormatanRapat();
        $badan_kehormatan_rapat ->nama = $request->input('nama');
        $badan_kehormatan_rapat ->email = $request->input('email');
        $badan_kehormatan_rapat ->tanggal = $request->input('tanggal');
        $badan_kehormatan_rapat ->waktu_mulai = $request->input('waktu_mulai');
        $badan_kehormatan_rapat ->waktu_selesai = $request->input('waktu_selesai');
        $badan_kehormatan_rapat ->jenis_rapat = $request->input('jenis_rapat');
        $badan_kehormatan_rapat ->agenda = $request->input('agenda');

        // Save the Rapat record to the database
        $badan_kehormatan_rapat ->save();

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('admin.buatrapat.badankehormatancreate')->with('success', 'Rapat berhasil dibuat!');
    }
}   
