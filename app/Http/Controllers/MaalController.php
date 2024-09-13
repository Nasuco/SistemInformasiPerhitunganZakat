<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZakatMaal;
use App\Models\Muzakki;

class MaalController extends Controller
{
    public function index()
    {
        $zakatMaalQuery = ZakatMaal::with('muzakki');

        $totalPeople = $zakatMaalQuery->count();
        $totalWeight = $zakatMaalQuery->sum('jumlah_rupiah');

        $zakatMaals = $zakatMaalQuery->paginate(10);
        return view('zakat_maal.index', compact('zakatMaals', 'totalPeople', 'totalWeight'));
    }

    public function create()
    {
        $muzakkis = Muzakki::all();
        $jumlah_rupiah = 0;
        // Menampilkan form untuk menambahkan data zakat maal
        return view('zakat_maal.create', compact('muzakkis', 'jumlah_rupiah'));
    }

    public function store(Request $request)
    {
        // Menyimpan data zakat maal yang baru
        $request->validate([
            'muzakki_id' => 'required',
            'jumlah_rupiah' => 'required|numeric',
            'tanggal_penerimaan' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        ZakatMaal::create($request->all());

        return redirect()->route('maal.index')->with('success', 'Data Zakat Maal berhasil ditambahkan!');
    }

    public function show($id)
    {
        $zakatMaals = ZakatMaal::findOrFail($id);
        return view('zakat_maal.show', compact('zakatMaals'));
    }

    public function edit($id)
    {
        $zakatMaals = ZakatMaal::findOrFail($id);
        $muzakkis = Muzakki::all();
        return view('zakat_maal.update', compact('zakatMaals', 'muzakkis'));
    }

    public function update(Request $request, ZakatMaal $zakatMaal)
    {
        // Memperbarui data zakat maal yang ada
        $request->validate([
            'muzakki_id' => 'required',
            'jumlah_rupiah' => 'required|numeric',
            'tanggal_penerimaan' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $zakatMaal->update($request->all());

        return redirect()->route('maal.index')->with('success', 'Data Zakat Maal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $zakatMaals = ZakatMaal::findOrFail($id);
        $zakatMaals->delete();

        return redirect()->route('maal.index')->with('success', 'Data Zakat Maal berhasil dihapus!');
    }

    public function searchMaal(Request $request)
    {
        $query = $request->input('muzakki');
        
        $zakatMaals = ZakatMaal::with('muzakki')
            ->whereHas('muzakki', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('alamat_rt', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        $totalPeople = $zakatMaals->total();
        $totalWeight = $zakatMaals->sum('jumlah_rupiah');
        
        return view('zakat_maal.index', compact('zakatMaals', 'totalPeople', 'totalWeight'));
    }
}
