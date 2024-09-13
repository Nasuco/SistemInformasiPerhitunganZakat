<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakatBeras extends Model
{
    use HasFactory;

    protected $table = 'zakat_beras';

    protected $fillable = [
        'muzakki_id',
        'kilogram',
        'jumlah_keluarga',
        'jumlah_kg',
        'tanggal_penerimaan',
        'keterangan',
    ];

    protected $casts = [
        'jumlah_kg' => 'decimal:1',
    ];

    // Definisikan relasi ke model Muzakki
    public function muzakki()
    {
        return $this->belongsTo(Muzakki::class, 'muzakki_id');
    }

    // Definisikan relasi ke model CalculateBeras
    public function calculate_beras()
    {
        return $this->hasOne(CalculateBeras::class);
    }
}
