<?php

namespace App\Http\Controllers;
use App\Models\BadanKehormatanRapat;
use Illuminate\Http\Request;

class BadanKehormatanRapatUserController extends Controller
{
    public function index()
    {
        $rapats = BadanKehormatanRapat::all();
        return view('komisi.agenda-komisi.rapatbadankehormatan', compact('rapats'));
    }

    public function mulaiRapat($id)
    {
        $rapat = BadanKehormatanRapat::findOrFail($id);
        return view('komisi.agenda-komisi.mulairapat', compact('rapat'));
    }
}
