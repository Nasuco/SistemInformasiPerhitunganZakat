<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakatMaal extends Model
{
    use HasFactory;

    protected $table = 'zakat_maal';

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
