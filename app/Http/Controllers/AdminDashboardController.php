<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        $total_category = Category::all()->count();;
        return view('admin.dashboard', ['total_category' => $total_category]);
    }
}
