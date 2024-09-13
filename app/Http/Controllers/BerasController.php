<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZakatBeras;
use App\Models\Muzakki;
use App\Models\CalculateBeras;

class BerasController extends Controller
{
    public function index()
    {
        $zakatBerasQuery = ZakatBeras::with('muzakki');

        $totalPeople = $zakatBerasQuery->count();
        $totalWeight = $zakatBerasQuery->sum('jumlah_kg');
        $totalFamilies = $zakatBerasQuery->sum('jumlah_keluarga');

        // Mengambil data dari tabel calculate_beras
        $calculateBerasData = CalculateBeras::first();

        // Memastikan jumlah mustahik tidak nol untuk menghindari pembagian oleh nol
        $jumlahMustahik = ($calculateBerasData) ? $calculateBerasData->jumlah_mustahik : 0;

        // Melakukan perhitungan rata-rata berat per mustahik
        $averageWeightPerMustahik = ($jumlahMustahik > 0) ? ($totalWeight / $jumlahMustahik) : 0;

        $canEditJumlahMustahik = (!$calculateBerasData || $calculateBerasData->editable);
        $showEditButton = (!$calculateBerasData || !$calculateBerasData->editable);

        $zakatBeras = $zakatBerasQuery->paginate(10);

        return view('zakat_beras.index', compact('zakatBeras', 'totalPeople', 'totalWeight', 'totalFamilies', 'averageWeightPerMustahik', 'calculateBerasData', 'canEditJumlahMustahik', 'showEditButton'));
    }

    public function saveManualInput(Request $request)
    {
        $request->validate([
            'jumlah_mustahik' => 'required|integer|min:1',
        ]);

        $jumlahMustahik = $request->input('jumlah_mustahik');

        // Mengambil data dari tabel calculate_beras
        $calculateBerasData = CalculateBeras::first();

        // Memastikan jumlah mustahik tidak nol untuk menghindari pembagian oleh nol
        if ($jumlahMustahik > 0) {
            $totalWeight = ZakatBeras::sum('jumlah_kg');

            // Hitung total_per_kg sebagai hasil pembagian berat total dengan jumlah mustahik
            $totalPerKg = $totalWeight / $jumlahMustahik;

            // Simpan atau update data di tabel calculate_beras
            if (!$calculateBerasData) {
                CalculateBeras::create([
                    'jumlah_mustahik' => $jumlahMustahik,
                    'total_per_kg' => $totalPerKg,
                    'editable' => true,
                ]);
            } else {
                $calculateBerasData->update([
                    'jumlah_mustahik' => $jumlahMustahik,
                    'total_per_kg' => $totalPerKg,
                    'editable' => true,
                ]);
            }

            return redirect()->route('beras.index')->with('success', 'Jumlah mustahik saved successfully.');
        } else {
            return redirect()->route('beras.index')->with('error', 'Jumlah mustahik harus lebih dari 0.');
        }
    }

    public function create()
    {
        $muzakkis = Muzakki::all();
        return view('zakat_beras.create', ['muzakkis' => $muzakkis]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'muzakki_id' => 'required',
            'kilogram' => 'required|numeric|min:2.8',
            'jumlah_keluarga' => 'required',
            'tanggal_penerimaan' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $totalJumlahKg = $request->input('kilogram') * $request->input('jumlah_keluarga');

        $requestData = $request->all();
        $requestData['jumlah_kg'] = $totalJumlahKg;

        ZakatBeras::create($requestData);

        return redirect()->route('beras.index')->with('success', 'Zakat Beras created successfully!');
    }

    public function show($id)
    {
        $zakatBeras = ZakatBeras::findOrFail($id);
        return view('zakat_beras.show', compact('zakatBeras'));
    }

    // public function edit($id)
    // {
    //     $zakatBeras = ZakatBeras::findOrFail($id);
    //     return view('zakat_beras.update', compact('zakatBeras'));
    // }
    public function edit(ZakatBeras $zakatBeras)
    {
        // dd($zakatBeras->id);
        $muzakkis = Muzakki::all(); 
        return view('zakat_beras.update', compact('zakatBeras', 'muzakkis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'muzakki_id' => 'required',
            'kilogram' => 'required|numeric|min:2.8',
            'jumlah_keluarga' => 'required',
            'tanggal_penerimaan' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Calculate the total jumlah_kg based on kilogram and jumlah_keluarga
        $totalJumlahKg = $request->input('kilogram') * $request->input('jumlah_keluarga');

        // Add the calculated total_jumlah_kg to the request data
        $requestData = $request->all();
        $requestData['jumlah_kg'] = $totalJumlahKg;

        // Find the ZakatBeras instance by ID
        $zakatBeras = ZakatBeras::findOrFail($id);

        // Update the ZakatBeras instance with the updated data
        $zakatBeras->update($requestData);

        return redirect()->route('beras.index')->with('success', 'Zakat Beras updated successfully!');
    }


    public function destroy($id)
    {
        $zakatBeras = ZakatBeras::findOrFail($id);
        $zakatBeras->delete();

        return redirect()->route('beras.index')->with('delete', 'Zakat Beras deleted successfully!');
    }

    public function searchBeras(Request $request)
    {
        $query = $request->input('muzakki');
        
        $zakatBeras = ZakatBeras::with('muzakki')
            ->whereHas('muzakki', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('alamat_rt', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        $totalPeople = $zakatBeras->total();
        $totalWeight = $zakatBeras->sum('jumlah_kg');
        $totalFamilies = $zakatBeras->sum('jumlah_keluarga');
        
        return view('zakat_beras.index', compact('zakatBeras', 'totalPeople', 'totalWeight', 'totalFamilies'));
    }


}
