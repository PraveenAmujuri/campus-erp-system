<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display dashboard for admin users.
     */
    public function adminDashboard()
    {
        return view('dashboard.admin');
    }

    /**
     * Display dashboard for faculty users.
     */
    public function facultyDashboard()
    {
        return view('dashboard.faculty');
    }

    /**
     * Display dashboard for student users.
     */
    public function studentDashboard()
    {
        return view('dashboard.student');
    }
}