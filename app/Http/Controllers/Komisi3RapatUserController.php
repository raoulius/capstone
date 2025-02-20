<?php

namespace App\Http\Controllers;
use App\Models\Komisi3Rapat;
use Illuminate\Http\Request;

class Komisi3RapatUserController extends Controller
{
    public function index()
    {
        $rapats = Komisi3Rapat::all();
        return view('komisi.agenda-komisi.rapatkomisi3', compact('rapats'));
    }

    public function mulaiRapat($id)
    {
        $rapat = Komisi3Rapat::findOrFail($id);
        return view('komisi.agenda-komisi.mulairapat', compact('rapat'));
    }
}
