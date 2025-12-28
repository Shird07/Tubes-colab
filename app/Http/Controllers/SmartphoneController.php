<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use Illuminate\Http\Request;

class SmartphoneController extends Controller
{
    // MENAMPILKAN DATA
    public function index()
    {
        $smartphones = Smartphone::all();
        return view('smartphones.index', compact('smartphones'));
    }

    // MENAMPILKAN FORM TAMBAH
    public function create()
    {
        return view('smartphones.create');
    }

    // MENYIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'ram' => 'required|integer',
            'camera' => 'required|integer',
            'battery' => 'required|integer',
            'price' => 'required|integer',
        ]);

        Smartphone::create($request->all());

        return redirect()->route('smartphones.index');
    }
}
