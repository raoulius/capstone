<?php

namespace App\Http\Controllers;
use App\Models\Komisi4Rapat;
use Illuminate\Http\Request;

class Komisi4RapatUserController extends Controller
{
    public function index()
    {
        $rapats = Komisi4Rapat::all();
        return view('komisi.agenda-komisi.rapatkomisi4', compact('rapats'));
    }

    public function mulaiRapat($id)
    {
        $rapat = Komisi4Rapat::findOrFail($id);
        return view('komisi.agenda-komisi.mulairapat', compact('rapat'));
    }
}
