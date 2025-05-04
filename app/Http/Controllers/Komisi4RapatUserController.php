<?php

namespace App\Http\Controllers;
use App\Models\Komisi4Rapat;
use Illuminate\Http\Request;

class Komisi4RapatUserController extends Controller
{
    public function index()
    {
        return view('komisi.agenda-komisi.rapat', [
            'rapats' => Komisi4Rapat::all(),
            'komisiRoute' => 'komisi-iv',
            'komisiName' => 'Komisi IV'
        ]);
    }

    public function mulaiRapat($id)
    {
        $rapat = Komisi4Rapat::findOrFail($id);
        $komisi_type = 'Komisi IV';
        return view('komisi.agenda-komisi.mulairapat', compact('rapat', 'komisi_type'));
    }
}
