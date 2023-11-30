<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'program_id', 'status', 'pengajar_id'];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    public function pengajar()
    {
        return $this->belongsTo(User::class, 'pengajar_id', 'id');
    }
}
