<?php

namespace App\Http\Controllers;
use App\Models\BuatRapat;
use Illuminate\Http\Request;

class Komisi1RapatUserController extends Controller
/*Each user controller is for each komisi to display the rapat page after they log in, 
different from Komisi1RapatController that is for the logic to create a new rapat
*/
{
    public function index()
    {
        return view('komisi.agenda-komisi.rapat', [
            'rapats' => BuatRapat::all(),
            'komisiRoute' => 'komisi-i',
            'komisiName' => 'Komisi I'
        ]);
    }

    public function mulaiRapat($id)
    {
        $rapat = BuatRapat::findOrFail($id);
        $komisi_type = 'Komisi I';
        return view('komisi.agenda-komisi.mulairapat', compact('rapat', 'komisi_type'));
    }
}