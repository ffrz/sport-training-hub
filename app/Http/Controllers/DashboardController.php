<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', 'this_month');
        $start_date = new Carbon(date('Y-m-01'));
        if ($month === 'prev_month') {
            $start_date = $start_date->copy()->subMonth()->startOfMonth();
        }
        else if ($month === 'prev_2month') {
            $start_date = $start_date->copy()->subMonth(2)->startOfMonth();
        }
        else if ($month === 'prev_3month') {
            $start_date = $start_date->copy()->subMonth(3)->startOfMonth();
        }
        $end_date = $start_date->copy()->endOfMonth();

        $days = [];
        for ($i = 1; $i <= substr($end_date, 8, 2); $i++) {
            $days[(int)$i] = 0;
        }

        return inertia('dashboard/Index', [
            'summary' => [
                'active_student_count' => Student::getActiveCount(),
                'active_coach_count' => Coach::getActiveCount(),
                'active_user_count' => User::getActiveCount(),
            ]
        ]);
    }

    public function data(Request $request)
    {
        return response()->json([]);
    }
}
