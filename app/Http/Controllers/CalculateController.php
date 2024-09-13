<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalculateBeras;
use App\Models\ZakatBeras;

class CalculateController extends Controller
{
    public function index()
    {
        $calculate = CalculateBeras::all();
        return view('calculate.index', compact('calculate'));
    }

    public function create()
    {
        $zakat = ZakatBeras::all();
        return view('calculate.create', compact('zakat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_mustahik' => 'required|numeric',
            'total_per_kg' => 'required|numeric',
            'zakat_beras_id' => 'required|numeric',
        ]);

        CalculateBeras::create($request->all());
        return redirect()->route('calculate.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $calculate = CalculateBeras::findOrFail($id);
        $zakat = ZakatBeras::all();
        return view('calculate.edit', compact('calculate', 'zakat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_mustahik' => 'required|numeric',
            'total_per_kg' => 'required|numeric',
            'zakat_beras_id' => 'required|numeric',
        ]);

        $calculate = CalculateBeras::findOrFail($id);
        $calculate->update($request->all());
        return redirect()->route('calculate.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $calculate = CalculateBeras::findOrFail($id);
        $calculate->delete();
        return redirect()->route('calculate.index')->with('success', 'Data berhasil dihapus');
    }
}
