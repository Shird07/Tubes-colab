<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use Illuminate\Http\Request;

class SmartphoneController extends Controller
{
    // MENAMPILKAN DATA (boleh admin & user)
    public function index()
    {
        $smartphones = Smartphone::all();
        return view('smartphones.index', compact('smartphones'));
    }

    // FORM TAMBAH (ADMIN ONLY)
    public function create()
    {
        return view('smartphones.create');
    }

    // SIMPAN DATA (ADMIN ONLY)
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'brand'   => 'required|string',
            'ram'     => 'required|integer',
            'camera'  => 'required|integer',
            'battery' => 'required|integer',
            'price'   => 'required|integer',
        ]);

        Smartphone::create($request->all());

        return redirect()
            ->route('smartphones.index')
            ->with('success', 'Data smartphone berhasil ditambahkan');
    }

    // FORM EDIT (ADMIN ONLY)
    public function edit(Smartphone $smartphone)
    {
        return view('smartphones.edit', compact('smartphone'));
    }

    // UPDATE (ADMIN ONLY)
    public function update(Request $request, Smartphone $smartphone)
    {
        $request->validate([
            'name'    => 'required|string',
            'brand'   => 'required|string',
            'ram'     => 'required|integer',
            'camera'  => 'required|integer',
            'battery' => 'required|integer',
            'price'   => 'required|integer',
        ]);

        $smartphone->update($request->all());

        return redirect()
            ->route('smartphones.index')
            ->with('success', 'Data berhasil diupdate');
    }

    // HAPUS (ADMIN ONLY)
    public function destroy(Smartphone $smartphone)
    {
        $smartphone->delete();

        return redirect()
            ->route('smartphones.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
