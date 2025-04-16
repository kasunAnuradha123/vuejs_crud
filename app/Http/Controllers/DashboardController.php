<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
       return Inertia::render('Dashboard', [
            'usersCount' => User::where('status', 'active')->count(),
        ]);
    }
}
