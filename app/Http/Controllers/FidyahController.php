<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muzakki;
use App\Models\Fidyah;

class FidyahController extends Controller
{
    public function index()
    {
        $fidyahQuery = Fidyah::with('muzakki');

        $totalPeople = $fidyahQuery->count();
        $totalWeight = $fidyahQuery->sum('jumlah_rupiah');

        $fidyah = $fidyahQuery->paginate(10);
        return view('fidyah.index', compact('fidyah', 'totalPeople', 'totalWeight'));
    }

    public function create()
    {
        $muzakkis = Muzakki::all();
        $jumlah_rupiah = 0;
        // Menampilkan form untuk menambahkan data zakat maal
        return view('fidyah.create', compact('muzakkis', 'jumlah_rupiah'));
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

        Fidyah::create($request->all());

        return redirect()->route('fidyah.index')->with('success', 'Data Fidyah berhasil ditambahkan!');
    }

    public function show($id)
    {
        $fidyah = Fidyah::findOrFail($id);
        return view('fidyah.show', compact('fidyah'));
    }

    public function edit($id)
    {
        $fidyah = Fidyah::findOrFail($id);
        $muzakkis = Muzakki::all();
        return view('fidyah.update', compact('fidyah', 'muzakkis'));
    }

    public function update(Request $request, Fidyah $fidyah)
    {
        // Memperbarui data zakat maal yang ada
        $request->validate([
            'muzakki_id' => 'required',
            'jumlah_rupiah' => 'required|numeric',
            'tanggal_penerimaan' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $fidyah->update($request->all());

        return redirect()->route('fidyah.index')->with('success', 'Data Fidyah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $fidyah = Fidyah::findOrFail($id);
        $fidyah->delete();

        return redirect()->route('fidyah.index')->with('success', 'Data Fidyah berhasil dihapus!');
    }

    public function searchFidyah(Request $request)
    {
        $query = $request->input('muzakki');
        
        $fidyah = Fidyah::with('muzakki')
            ->whereHas('muzakki', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('alamat_rt', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        $totalPeople = $fidyah->total();
        $totalWeight = $fidyah->sum('jumlah_rupiah');
        
        return view('fidyah.index', compact('fidyah', 'totalPeople', 'totalWeight'));
    }
}
