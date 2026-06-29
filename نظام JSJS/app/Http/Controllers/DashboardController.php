<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseModel; // Assuming I name it this or similar

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
