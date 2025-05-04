<?php

namespace App\Http\Controllers;
use App\Models\BadanKehormatanRapat;
use Illuminate\Http\Request;

class BadanKehormatanRapatUserController extends Controller
{
    public function index()
    {
        return view('komisi.agenda-komisi.rapat', [
            'rapats' => BadanKehormatanRapat::all(),
            'komisiRoute' => 'badan-kehormatan',
            'komisiName' => 'Badan Kehormatan'
        ]);
    }

    public function mulaiRapat($id)
    {
        $rapat = BadanKehormatanRapat::findOrFail($id);
        $komisi_type = 'Badan Kehormatan';
        return view('komisi.agenda-komisi.mulairapat', compact('rapat', 'komisi_type'));
    }
}
