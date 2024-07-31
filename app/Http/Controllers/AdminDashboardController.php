<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        $total_category = DB::table('categories')->get()->count();
        return view('admin.dashboard', ['total_category' => $total_category]);
    }
}
