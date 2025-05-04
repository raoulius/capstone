<?php

namespace App\Http\Controllers;
use App\Models\BKSAPRapat;
use Illuminate\Http\Request;

class BKSAPRapatUserController extends Controller
{
    public function index()
    {
        return view('komisi.agenda-komisi.rapatbksap', [
            'rapats' => BKSAPRapat::all(),
            'komisiRoute' => 'bksap',
            'komisiName' => 'BKSAP'
        ]);
    }

    public function mulaiRapat($id)
    {
        $rapat = BKSAPRapat::findOrFail($id);
        $komisi_type = 'BKSAP';
        return view('komisi.agenda-komisi.mulairapat', compact('rapat', 'komisi_type'));
    }
}
