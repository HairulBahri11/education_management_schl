<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Raport extends Model
{
    use HasFactory;
    protected $table = "detail_raport";
    protected $fillable = [
        'id',
        'raport_id',
        'aspek_id',
        'detail_aspek_id',
        'nilai',
        'simbol_mutu',

    ];

    function raport()
    {
        return $this->belongsTo(Raport::class, 'raport_id', 'id');
    }

    function aspek()
    {
        return $this->belongsTo(Aspek_Penilaian::class, 'aspek_id', 'id');
    }

    function detail_aspek()
    {
        return $this->belongsTo(Detail_Aspek_Penilaian::class, 'detail_aspek_id', 'id');
    }
}
