<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komisi2Rapat;

class Komisi2RapatUserController extends Controller
{
    public function index()
    {
        $rapats = Komisi2Rapat::all();
        return view('komisi.agenda-komisi.rapatkomisi2', compact('rapats'));
    }

    public function mulaiRapat($id)
    {
        $rapat = Komisi2Rapat::findOrFail($id);
        return view('komisi.agenda-komisi.mulairapat', compact('rapat'));
    }
}