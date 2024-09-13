<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fidyah extends Model
{
    use HasFactory;

    protected $table = 'fidyah';

    protected $fillable = [
        'muzakki_id',
        'jumlah_rupiah',
        'tanggal_penerimaan',
        'keterangan',
    ];

    public function muzakki()
    {
        return $this->belongsTo(Muzakki::class);
    }
}
