<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Muzakki;
use App\Models\ZakatBeras;
use App\Models\ZakatUang;
use App\Models\ZakatMaal;
use App\Models\Fidyah;

class MuzakkiController extends Controller
{
    public function index()
    {
        $muzakkis = Muzakki::all();

        return view('muzakki.index', compact('muzakkis'));
    }

    public function home()
    {
        // Menghitung total jumlah muzakki dari Zakat Beras
        $totalMuzakkiBeras = ZakatBeras::count('muzakki_id');
        $totalJiwaBeras = ZakatBeras::sum('jumlah_keluarga');

        // Menghitung total jumlah muzakki dari Zakat Uang
        $totalMuzakkiUang = ZakatUang::count('muzakki_id');
        $totalJiwaUang = ZakatUang::sum('jumlah_keluarga');

        // Menghitung total jumlah muzakki dari Zakat Maal
        $totalMuzakkiMaal = ZakatMaal::count('muzakki_id');

        // Menghitung total jumlah muzakki dari Fidyah
        $totalMuzakkiFidyah = Fidyah::count('muzakki_id');

        $chartDataBeras = ZakatBeras::join('muzakki', 'muzakki.id', '=', 'zakat_beras.muzakki_id')
            ->groupBy('muzakki.alamat_rt')
            ->selectRaw('muzakki.alamat_rt, SUM(zakat_beras.jumlah_kg) as total_kg')
            ->pluck('total_kg', 'alamat_rt');
        
        $chartDataUang = ZakatUang::join('muzakki', 'muzakki.id', '=', 'zakat_uang.muzakki_id')
            ->groupBy('muzakki.alamat_rt')
            ->selectRaw('muzakki.alamat_rt, SUM(zakat_uang.jumlah_rupiah) as total_rp')
            ->pluck('total_rp', 'alamat_rt');

        $totalKgBerasAll = ZakatBeras::sum('jumlah_kg');
        $totalRpUangAll = ZakatUang::sum('jumlah_rupiah');
        $totalRpMaalAll = ZakatMaal::sum('jumlah_rupiah');
        $totalRpFidyahAll = Fidyah::sum('jumlah_rupiah');

        $totalKgBeras = ZakatBeras::join('muzakki', 'muzakki.id', '=', 'zakat_beras.muzakki_id')
            ->groupBy('zakat_beras.tanggal_penerimaan')
            ->selectRaw('zakat_beras.tanggal_penerimaan, SUM(zakat_beras.jumlah_kg) as total_kg')
            ->orderBy('zakat_beras.tanggal_penerimaan', 'desc') // Menambahkan order by descending
            ->pluck('total_kg', 'tanggal_penerimaan');

        $totalRpUang = ZakatUang::join('muzakki', 'muzakki.id', '=', 'zakat_uang.muzakki_id')
            ->groupBy('zakat_uang.tanggal_penerimaan')
            ->selectRaw('zakat_uang.tanggal_penerimaan, SUM(zakat_uang.jumlah_rupiah) as total_rp')
            ->orderBy('zakat_uang.tanggal_penerimaan', 'desc') // Menambahkan order by descending
            ->pluck('total_rp', 'tanggal_penerimaan');

        $totalRpMaal = ZakatMaal::join('muzakki', 'muzakki.id', '=', 'zakat_maal.muzakki_id')
            ->groupBy('zakat_maal.tanggal_penerimaan')
            ->selectRaw('zakat_maal.tanggal_penerimaan, SUM(zakat_maal.jumlah_rupiah) as total_rp')
            ->orderBy('zakat_maal.tanggal_penerimaan', 'desc') // Menambahkan order by descending
            ->pluck('total_rp', 'tanggal_penerimaan');

        $totalRpFidyah = Fidyah::join('muzakki', 'muzakki.id', '=', 'fidyah.muzakki_id')
            ->groupBy('fidyah.tanggal_penerimaan')
            ->selectRaw('fidyah.tanggal_penerimaan, SUM(fidyah.jumlah_rupiah) as total_rp')
            ->orderBy('fidyah.tanggal_penerimaan', 'desc') // Menambahkan order by descending
            ->pluck('total_rp', 'tanggal_penerimaan');

        return view('muzakki.home', compact('totalMuzakkiBeras', 'totalMuzakkiUang', 'totalMuzakkiMaal', 'totalMuzakkiFidyah', 'totalJiwaBeras', 'totalJiwaUang', 'chartDataBeras', 'chartDataUang', 'totalKgBeras', 'totalRpUang', 'totalKgBerasAll', 'totalRpUangAll', 'totalRpMaal', 'totalRpFidyah', 'totalRpMaalAll', 'totalRpFidyahAll'));
    }

    public function create()
    {
        return view('muzakki.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'rt' => 'required|string',
            'alamat_rt' => ($request->input('rt') === 'lainnya') ? 'required|string' : '',
        ]);

        $data = [
            'name' => $request->input('name'),
            'alamat_rt' => ($request->input('rt') === 'lainnya') ? $request->input('alamat_rt') : $request->input('rt'),
        ];

        Muzakki::create($data);

        return redirect()->route('muzakki')->with('success', 'Muzakki berhasil ditambahkan.');
    }

    // public function show(Muzakki $muzakk, $id)
    // {
    //     $muzakki = Muzakki::findOrFail($id);
    //     return view('backend.muzakki.show', compact('muzakki'));
    // }

    public function edit(Muzakki $muzakki)
    {
        return view('muzakki.update', compact('muzakki'));
    }

    public function update(Request $request, $id)
    {
        try {
            $muzakki = Muzakki::findOrFail($id);
    
            // dd($muzakki);
            $request->validate([
                'name' => 'required|string|max:255',
                'rt' => 'required|string',
                'alamat_rt' => ($request->input('rt') === 'lainnya') ? 'required|string' : '',
            ]);
    
            $data = [
                'name' => $request->input('name'),
                'alamat_rt' => ($request->input('rt') === 'lainnya') ? $request->input('alamat_rt', $muzakki->alamat_rt) : $request->input('rt'),
            ];
    
            $muzakki->update($data);
    
            return redirect()->route('muzakki')->with('success', 'Muzakki berhasil diperbarui.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi. Error: ' . $e->getMessage());
            }
    }

    public function destroy(Muzakki $muzakki)
    {
        $muzakki->delete();

        return redirect()->route('muzakki')
            ->with('success', 'Muzakki deleted successfully');
    }

    // search
    public function searchMuzakki(Request $request)
    {
        $muzakki = $request->input('muzakki');
        $muzakkis = Muzakki::where('name', 'like', "%$muzakki%")->get();

        return view('muzakki.index', compact('muzakkis'));
    }
}
