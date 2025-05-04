<?php

namespace App\Http\Controllers;
use App\Models\Komisi3Rapat;
use Illuminate\Http\Request;

class Komisi3RapatUserController extends Controller
{
    public function index()
    {
        return view('komisi.agenda-komisi.rapat', [
            'rapats' => Komisi3Rapat::all(),
            'komisiRoute' => 'komisi-iii',
            'komisiName' => 'Komisi III'
        ]);
    }

    public function mulaiRapat($id)
    {
        $rapat = Komisi3Rapat::findOrFail($id);
        $komisi_type = 'Komisi III';
        return view('komisi.agenda-komisi.mulairapat', compact('rapat', 'komisi_type'));
    }
}
