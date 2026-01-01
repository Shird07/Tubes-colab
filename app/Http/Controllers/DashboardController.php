<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use App\Models\User;

class DashboardController extends Controller
{
   public function index()
{
    $totalSmartphone = Smartphone::count();
    $totalUser = User::count();

    return view('dashboard', compact(
        'totalSmartphone',
        'totalUser'
    ));
}

}
