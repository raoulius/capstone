<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisi2Rapat extends Model
{
    use HasFactory;

    // If your table name is not the plural of the model name, define it here
    protected $table = 'komisi2_rapat';

    // Define the fields that are mass assignable
    protected $fillable = [
        'nama',
        'email',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'jenis_rapat',
        'agenda',
        'komisi_id',
    ];

    protected static function boot()
{
    parent::boot();
    static::creating(function ($model) {
        $model->komisi_id = 2; // Auto-set for Komisi 2
    });
}

// app/Models/Komisi2Rapat.php
public function unified_attendances()
{
    return $this->morphMany(Attendance::class, 'rapat');
}

public function attendances()
{
    return $this->hasMany(Attendance::class, 'rapat_id');
}
}