<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Aspek_Penilaian extends Model
{
    use HasFactory;
    protected $table = 'detail_aspek_penilaian';
    protected $fillable = [
        'aspek_penilaian_id',
        'nama_detail_aspek_penilaian'
    ];

    public function aspek_penilaian()
    {
        return $this->belongsTo(Aspek_Penilaian::class, 'aspek_penilaian_id', 'id');
    }
}
