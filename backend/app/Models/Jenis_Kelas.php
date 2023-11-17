<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Jenis_Kelas extends Model
{
    use HasFactory, HasRoles;
    protected $table = 'jenis_kelas';
    protected $fillable = ['nama_jenis_kelas', 'deskripsi'];
}
