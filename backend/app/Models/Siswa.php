<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = ['pendaftaran_id','kode_siswa', 'foto', 'nama_siswa', 'jenis_kelamin', 'tempat_lahir', 'tgl_lahir'];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class , 'pendaftaran_id');
    }
}
