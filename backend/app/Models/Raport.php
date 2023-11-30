<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    use HasFactory;
    protected $table = 'raport';
    protected $fillable = [
        'id',
        'kelas_id',
        'siswa_id',
        'program_id',
        'pengajar_id',
        'total_nilai',
        'awal_tahun_ajaran',
        'akhir_tahun_ajaran',
        'topik_aktifitas',
        'catatan',

    ];

    public function pengajar()
    {
        return $this->belongsTo(User::class, 'pengajar_id', 'id');
    }
}
