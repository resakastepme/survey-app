<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    use HasFactory;

    protected $table = 'results';
    protected $fillable = [
        'responden_id',
        'menggunakan_email',
        'mengalami',
        'kesadaran',
        'korban',
        'pengguna_extension',
        'pengguna_extension_spesifik',
        'deteksi_email',
        'mempertimbangkan',
        'fitur_utama',
        'seberapa_nyaman',
        'platform_email',
    ];

    public function getResponden()
    {
        return $this->belongsTo(Respondens::class, 'responden_id', 'id');
    }

    public $timestamps = true;
}
