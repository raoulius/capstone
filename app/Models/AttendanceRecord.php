<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'rapat_id',
        'nama',
        'email',
        'waktu_absen',
        'komisi_type'
    ];

    public function rapat()
    {
        return $this->belongsTo(MasterRapat::class, 'rapat_id');
    }
} 