<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respondens extends Model
{
    use HasFactory;

    protected $table = 'respondens';
    protected $fillable = [
        'result_id',
        'nama',
        'email',
        'jenis_kelamin',
        'rentang_usia',
        'pekerjaan',
        'bidang_industri',
        'agree_to_show',
        'agree_sent_email',
        'emote',
    ];

    public function getResult()
    {
        return $this->belongsTo(Results::class, 'result_id', 'id');
    }

    public $timestamps = true;
}
