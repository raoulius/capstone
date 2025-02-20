<?php

namespace App\Http\Controllers;
use App\Models\BadanAnggaranRapat;
use Illuminate\Http\Request;

class BadanAnggaranRapatUserController extends Controller
{
    public function index()
    {
        $rapats = BadanAnggaranRapat::all();
        return view('komisi.agenda-komisi.rapatbadananggaran', compact('rapats'));
    }

    public function mulaiRapat($id)
    {
        $rapat = BadanAnggaranRapat::findOrFail($id);
        return view('komisi.agenda-komisi.mulairapat', compact('rapat'));
    }
}
