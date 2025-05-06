<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'email',
        'name',
        'role_id',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function faces() {
        return $this->hasMany(UserFace::class);
    }

    public function attendanceRecords() {
        return $this->hasMany(AttendanceRecord::class);
    }
}
