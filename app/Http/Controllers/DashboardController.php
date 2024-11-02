<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            abort(401);
        }
        return view('auth.dashboard');
    }

    public function publicDashboard()
    {
        $devices = Device::all();

        return view('dashboard.public', compact('devices'));
    }
}
