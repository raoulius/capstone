<?php

namespace App\Http\Controllers;
use App\Models\BadanLegislasiRapat;
use Illuminate\Http\Request;

class BadanLegislasiRapatUserController extends Controller
{
    public function index()
    {
        $rapats = BadanLegislasiRapat::all();
        return view('komisi.agenda-komisi.rapatbadanlegislasi', compact('rapats'));
    }

    public function mulaiRapat($id)
    {
        $rapat = BadanLegislasiRapat::findOrFail($id);
        return view('komisi.agenda-komisi.mulairapat', compact('rapat'));
    }
}
