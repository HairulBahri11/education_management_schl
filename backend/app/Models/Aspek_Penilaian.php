<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspek_Penilaian extends Model
{
    use HasFactory;
    protected $table = 'aspek_penilaian';
    protected $fillable = [
        'aspek_penilaian',
        'bidang'
    ];
}
