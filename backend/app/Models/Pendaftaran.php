<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $fillable = ['kode_pendaftaran', 'id_orangtua', 'nama_anak', 'asal_sekolah', 'id_program', 'status', 'tgl_daftar', 'bukti_pembayaran', 'status_pembayaran', 'catatan'];

    public function program()
    {
        return $this->belongsTo(Program::class, 'id_program');
    }

    public function orangtua()
    {
        return $this->belongsTo(User::class, 'id_orangtua');
    }
}
