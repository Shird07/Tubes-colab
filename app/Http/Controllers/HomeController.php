<?php

namespace App\Http\Controllers;

use App\Models\Partner;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data partner dari database
        $partners = Partner::all();

        // Kirim ke view home
        return view('pages.home', compact('partners'));
    }
}
