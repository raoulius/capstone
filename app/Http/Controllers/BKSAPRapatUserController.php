<?php

namespace App\Http\Controllers;
use App\Models\BKSAPRapat;
use Illuminate\Http\Request;

class BKSAPRapatUserController extends Controller
{
    public function index()
    {
        $rapats = BKSAPRapat::all();
        return view('komisi.agenda-komisi.rapatbksap', compact('rapats'));
    }

    public function mulaiRapat($id)
    {
        $rapat = BKSAPRapat::findOrFail($id);
        return view('komisi.agenda-komisi.mulairapat', compact('rapat'));
    }
}
