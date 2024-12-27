<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRapat extends Model
{
    protected $table = 'master_rapat';
    
    protected $fillable = [
        'nama',
        'email',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'jenis_rapat',
        'agenda',
        'komisi_type',
        'original_id'
    ];
}