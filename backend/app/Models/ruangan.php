<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    protected $fillable = ['petugas_id','nama_ruangan', 'kapasitas',];

    public function petugas(){
        return $this->belongsTo(Petugas::class, 'petugas_id' , 'id');
    }
}
