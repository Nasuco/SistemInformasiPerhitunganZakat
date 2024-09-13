<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muzakki;
use App\Models\ZakatBeras;
use App\Models\ZakatUang;
use App\Models\ZakatMaal;
use App\Models\Fidyah;
use PDF;

class RekapController extends Controller
{
    public function index()
    {
        $jumlahOrangBeras = ZakatBeras::join('muzakki', 'muzakki.id', '=', 'zakat_beras.muzakki_id')
            ->groupBy('muzakki.alamat_rt')
            ->selectRaw('muzakki.alamat_rt, COUNT(DISTINCT zakat_beras.muzakki_id) as jumlah_orang, SUM(zakat_beras.jumlah_kg) as jumlah_beras')
            ->get();

        $totalOrangBeras = $jumlahOrangBeras->sum('jumlah_orang');
        $totalKgBeras = $jumlahOrangBeras->sum('jumlah_beras');

        $jumlahOrangUang = ZakatUang::join('muzakki', 'muzakki.id', '=', 'zakat_uang.muzakki_id')
            ->groupBy('muzakki.alamat_rt')
            ->selectRaw('muzakki.alamat_rt, COUNT(DISTINCT zakat_uang.muzakki_id) as jumlah_orang, SUM(zakat_uang.jumlah_rupiah) as jumlah_uang_rp')
            ->get();
        $totalOrangUang = $jumlahOrangUang->sum('jumlah_orang');
        $totalRpUang = $jumlahOrangUang->sum('jumlah_uang_rp');

        $jumlahOrangMaal = ZakatMaal::count('muzakki_id');

        $jumlahOrangFidyah = Fidyah::count('muzakki_id');

        return view('rekap.index', compact('jumlahOrangBeras', 'jumlahOrangUang', 'jumlahOrangMaal', 'jumlahOrangFidyah', 'totalOrangBeras', 'totalKgBeras', 'totalOrangUang', 'totalRpUang'));
    }

    public function generatePDF()
    {
        $jumlahOrangBeras = ZakatBeras::join('muzakki', 'muzakki.id', '=', 'zakat_beras.muzakki_id')
            ->groupBy('muzakki.alamat_rt')
            ->selectRaw('muzakki.alamat_rt, COUNT(DISTINCT zakat_beras.muzakki_id) as jumlah_orang, SUM(zakat_beras.jumlah_kg) as jumlah_beras')
            ->get();

        $totalOrangBeras = $jumlahOrangBeras->sum('jumlah_orang');
        $totalKgBeras = $jumlahOrangBeras->sum('jumlah_beras');

        $jumlahOrangUang = ZakatUang::join('muzakki', 'muzakki.id', '=', 'zakat_uang.muzakki_id')
            ->groupBy('muzakki.alamat_rt')
            ->selectRaw('muzakki.alamat_rt, COUNT(DISTINCT zakat_uang.muzakki_id) as jumlah_orang, SUM(zakat_uang.jumlah_rupiah) as jumlah_uang_rp')
            ->get();

        $totalOrangUang = $jumlahOrangUang->sum('jumlah_orang');
        $totalRpUang = $jumlahOrangUang->sum('jumlah_uang_rp');

        $totalOrangMaal = ZakatMaal::count('muzakki_id');
        $totalRpMaal = ZakatMaal::sum('jumlah_rupiah');

        $totalOrangFidyah = Fidyah::count('muzakki_id');
        $totalRpFidyah = Fidyah::sum('jumlah_rupiah');

        $pdf = PDF::loadView('rekap.pdf', compact('jumlahOrangBeras', 'jumlahOrangUang', 'totalOrangMaal', 'totalRpMaal', 'totalOrangFidyah', 'totalRpFidyah', 'totalOrangBeras', 'totalKgBeras', 'totalOrangUang', 'totalRpUang'));
        return $pdf->stream('rekap-zakat.pdf');
    }
}
