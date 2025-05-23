<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisi4Rapat extends Model
{
    use HasFactory;

    // If your table name is not the plural of the model name, define it here
    protected $table = 'komisi4_rapat';

    // Define the fields that are mass assignable
    protected $fillable = [
        'nama',
        'email',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'jenis_rapat',
        'agenda',
    ];
}