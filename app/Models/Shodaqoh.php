<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shodaqoh extends Model
{
    use HasFactory;

    protected $table = 'shodaqoh';

    protected $fillable = [
        'nama',
        'alamat_rt',
        'jumlah_rupiah',
        'tanggal_penerimaan',
        'keterangan',
    ];
}
