<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Dummy;

class DashboardController extends Controller
{
    public function index()
    {
        $recentUsersCount = User::where('created_at', '>=', now()->subMinutes(30))->count();

        $totalMembers = User::count();

        $membersRegisteredToday = User::whereDate('created_at', today())->count();

        return view('dashboard', compact('recentUsersCount', 'totalMembers', 'membersRegisteredToday'));
    }
}
