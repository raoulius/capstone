<?php

namespace App\Http\Controllers;
use App\Models\BadanLegislasiRapat;
use App\Models\MasterRapat;
use Illuminate\Http\Request;

class BadanLegislasiRapatUserController extends Controller
{
    public function index()
    {
        return view('komisi.agenda-komisi.rapat', [
            'rapats' => BadanLegislasiRapat::all(),
            'komisiRoute' => 'badan-legislasi',
            'komisiName' => 'Badan Legislasi'
        ]);
    }

    public function mulaiRapat($id)
    {
        $rapat = BadanLegislasiRapat::findOrFail($id);
        $komisi_type = 'Badan Legislasi';
        return view('komisi.agenda-komisi.mulairapat', compact('rapat', 'komisi_type'));
    }
}
