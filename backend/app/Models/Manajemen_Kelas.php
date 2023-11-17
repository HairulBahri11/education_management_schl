<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manajemen_Kelas extends Model
{
    use HasFactory;
    protected $table = 'manajemen_kelas';
    protected $fillable = ['siswa_id', 'kelas_id', 'tgl_mulai', 'tgl_selesai', 'status', 'program_id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
