<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
// app/Models/Attendance.php

protected $table = 'unified_attendance';
protected $fillable = ['komisi_id', 'rapat_id', 'rapat_type', 'name', 'confidence'];

public function rapat()
{
    return $this->morphTo();
}
}
