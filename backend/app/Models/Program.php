<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $table = 'programs';
    protected $fillable = ['nama_program', 'kategori_program', 'deskripsi', 'gambar', 'harga', 'active' , 'jeniskelas_id' , 'durasi'];

    public function jeniskelas(){
        return $this->belongsTo(Jenis_Kelas::class, 'jeniskelas_id' , 'id');
    }
}
