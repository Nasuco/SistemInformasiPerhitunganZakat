<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZakatUang;
use App\Models\Muzakki;

class UangController extends Controller
{
    public function index()
    {
        $zakatUangQuery = ZakatUang::with('muzakki');

        $totalPeople = $zakatUangQuery->count();
        $totalWeight = $zakatUangQuery->sum('jumlah_rupiah');
        $totalFamilies = $zakatUangQuery->sum('jumlah_keluarga');

        $zakatUang = $zakatUangQuery->paginate(10);
        return view('zakat_uang.index', compact('zakatUang', 'totalPeople', 'totalWeight', 'totalFamilies'));
    }

    public function create()
    {
        $muzakkis = Muzakki::all();
        $jumlah_rupiah = 0;
        return view('zakat_uang.create', compact('muzakkis', 'jumlah_rupiah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'muzakki_id' => 'required',
            'rupiah' => 'required|numeric|min:30000|max:30000',
            'jumlah_keluarga' => 'required|numeric',
            'jumlah_rupiah' => 'required|numeric',
            'tanggal_penerimaan' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $totalJumlahRp = $request->input('rupiah') * $request->input('jumlah_keluarga');

        $requestData = $request->all();
        $requestData['jumlah_rupiah'] = $totalJumlahRp;

        ZakatUang::create($requestData);

        return redirect()->route('uang.index')->with('success', 'Zakat Uang created successfully!');
    }

    public function show($id)
    {
        $zakatUang = ZakatUang::findOrFail($id);
        return view('zakat_uang.show', compact('zakatUang'));
    }

    public function edit($id)
    {
        $zakatUang = ZakatUang::findOrFail($id);
        $muzakkis = Muzakki::all();

        return view('zakat_uang.update', compact('zakatUang', 'muzakkis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'muzakki_id' => 'required',
            'rupiah' => 'required|numeric|min:30000|max:30000',
            'jumlah_keluarga' => 'required|numeric',
            'jumlah_rupiah' => 'required|numeric',
            'tanggal_penerimaan' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $totalJumlahRp = $request->input('rupiah') * $request->input('jumlah_keluarga');

        $requestData = $request->all();
        $requestData['jumlah_rupiah'] = $totalJumlahRp;

        $zakatUang = ZakatUang::findOrFail($id);
        $zakatUang->update($requestData);

        return redirect()->route('uang.index')->with('success', 'Zakat Uang updated successfully!');
    }


    public function destroy($id)
    {
        $zakatUang = ZakatUang::findOrFail($id);
        $zakatUang->delete();

        return redirect()->route('uang.index')->with('success', 'Zakat Uang deleted successfully!');
    }

    public function searchUang(Request $request)
    {
        $query = $request->input('muzakki');
        
        $zakatUang = ZakatUang::with('muzakki')
            ->whereHas('muzakki', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('alamat_rt', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        $totalPeople = $zakatUang->total();
        $totalWeight = $zakatUang->sum('jumlah_rupiah');
        $totalFamilies = $zakatUang->sum('jumlah_keluarga');
        
        return view('zakat_uang.index', compact('zakatUang', 'totalPeople', 'totalWeight', 'totalFamilies'));
    }
}
