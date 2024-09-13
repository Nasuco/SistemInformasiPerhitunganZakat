<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakatUang extends Model
{
    use HasFactory;

    protected $table = 'zakat_uang';

    protected $fillable = [
        'muzakki_id',
        'rupiah',
        'jumlah_keluarga',
        'jumlah_rupiah',
        'tanggal_penerimaan',
        'keterangan',
    ];

    // Definisikan relasi ke model Muzakki
    public function muzakki()
    {
        return $this->belongsTo(Muzakki::class);
    }
}
