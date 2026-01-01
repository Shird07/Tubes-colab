<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use Illuminate\Http\Request;

class SmartphoneController extends Controller
{
    // TAMPILKAN DATA (ADMIN & USER)
    public function index()
    {
        $smartphones = Smartphone::all();
        return view('smartphones.index', compact('smartphones'));
    }

    // FORM TAMBAH (ADMIN)
    public function create()
    {
        return view('smartphones.create');
    }

    // SIMPAN DATA (ADMIN)
    public function store(Request $request)
    {
        $request->validate([
            'company_name'     => 'required|string',
            'model_name'       => 'required|string',
            'mobile_weight'    => 'required|string',
            'ram'              => 'required|string',
            'front_camera'     => 'required|string',
            'back_camera'      => 'required|string',
            'processor'        => 'required|string',
            'battery_capacity' => 'required|string',
            'screen_size'      => 'required|string',
            'price_usa'        => 'required|string',
            'launched_year'    => 'required|integer',
        ]);

        Smartphone::create($request->only([
            'company_name',
            'model_name',
            'mobile_weight',
            'ram',
            'front_camera',
            'back_camera',
            'processor',
            'battery_capacity',
            'screen_size',
            'price_usa',
            'launched_year',
        ]));

        return redirect()
            ->route('smartphones.index')
            ->with('success', 'Data smartphone berhasil ditambahkan');
    }

    // FORM EDIT (ADMIN)
    public function edit(Smartphone $smartphone)
    {
        return view('smartphones.edit', compact('smartphone'));
    }

    // UPDATE DATA (ADMIN)
    public function update(Request $request, Smartphone $smartphone)
    {
        $request->validate([
            'company_name'     => 'required|string',
            'model_name'       => 'required|string',
            'mobile_weight'    => 'required|string',
            'ram'              => 'required|string',
            'front_camera'     => 'required|string',
            'back_camera'      => 'required|string',
            'processor'        => 'required|string',
            'battery_capacity' => 'required|string',
            'screen_size'      => 'required|string',
            'price_usa'        => 'required|string',
            'launched_year'    => 'required|integer',
        ]);

        $smartphone->update($request->only([
            'company_name',
            'model_name',
            'mobile_weight',
            'ram',
            'front_camera',
            'back_camera',
            'processor',
            'battery_capacity',
            'screen_size',
            'price_usa',
            'launched_year',
        ]));

        return redirect()
            ->route('smartphones.index')
            ->with('success', 'Data smartphone berhasil diupdate');
    }

    // HAPUS DATA (ADMIN)
    public function destroy(Smartphone $smartphone)
    {
        $smartphone->delete();

        return redirect()
            ->route('smartphones.index')
            ->with('success', 'Data smartphone berhasil dihapus');
    }
}
