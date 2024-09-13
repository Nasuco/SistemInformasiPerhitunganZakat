<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muzakki extends Model
{
    use HasFactory;

    protected $table = 'muzakki';

    protected $fillable = [
        'name',
        'alamat_rt',
    ];

    // connection zakat beras
    public function zakat_beras()
    {
        return $this->hasMany(ZakatBeras::class, 'muzakki_id', 'id');
    }

    // connection zakat uang
    public function zakat_uang()
    {
        return $this->hasMany(ZakatUang::class, 'muzakki_id', 'id');
    }

    // connection zakat maal
    public function zakat_maal()
    {
        return $this->hasMany(ZakatMaal::class, 'muzakki_id', 'id');
    }

    // connection fidyah
    public function fidyah()
    {
        return $this->hasMany(Fidyah::class, 'muzakki_id', 'id');
    }
}