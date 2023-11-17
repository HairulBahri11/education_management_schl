<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi_Detail extends Model
{
    use HasFactory;
    protected $table = 'absensi_detail';
    protected $fillable = [
        'absensi_id',
        'siswa_id',
        'kehadiran',
    ];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'absensi_id', 'id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function manajemenkelas()
    {
        return $this->belongsTo(ManajemenKelas::class, 'manajemen_kelas_id', 'id');
    }
}
