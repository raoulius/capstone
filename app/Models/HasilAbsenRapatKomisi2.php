<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilAbsenRapatKomisi2 extends Model
{
    protected $table = 'hasil_absen_rapat_komisi_2';
    
    protected $fillable = [
        'rapat_id',
        'name',
    ];

    public function rapat()
    {
        return $this->belongsTo(Komisi2Rapat::class, 'rapat_id');
    }
} 