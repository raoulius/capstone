<?php

namespace App\Http\Controllers;
use App\Models\BadanAnggaranRapat;
use Illuminate\Http\Request;

class BadanAnggaranRapatUserController extends Controller
{
    public function index()
    {
        return view('komisi.agenda-komisi.rapat', [
            'rapats' => BadanAnggaranRapat::all(),
            'komisiRoute' => 'badan-anggaran',
            'komisiName' => 'Badan Anggaran'
        ]);
    }

    public function mulaiRapat($id)
    {
        $rapat = BadanAnggaranRapat::findOrFail($id);
        $komisi_type = 'Badan Anggaran';
        return view('komisi.agenda-komisi.mulairapat', compact('rapat', 'komisi_type'));
    }
}
