<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculateBeras extends Model
{
    use HasFactory;

    protected $table = 'calculate_beras';

    protected $fillable = [
        'jumlah_mustahik',
        'total_per_kg',
    ];

    protected $casts = [
        'total_per_kg' => 'decimal:1',
    ];

    public function zakat_beras()
    {
        return $this->belongsTo(ZakatBeras::class, 'zakat_beras_id');
    }

}
