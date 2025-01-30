<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return inertia('dashboard/Index', []);
    }

    public function data(Request $request)
    {
        return response()->json([]);
    }
}
