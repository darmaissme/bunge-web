<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard with statistics and recent consultations.
     */
    public function index(): View
    {
        $totalBookings = Consultation::count();
        $confirmedCount = Consultation::where('status', 'confirmed')->count();
        $pendingCount = Consultation::where('status', 'pending')->count();
        $cancelledCount = Consultation::where('status', 'cancelled')->count();
        $completedCount = Consultation::where('status', 'completed')->count();

        // Calculate today's registrations using Asia/Jakarta timezone
        $todayBookings = Consultation::whereDate('created_at', Carbon::today('Asia/Jakarta'))->count();

        $recentBookings = Consultation::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'confirmedCount',
            'pendingCount',
            'cancelledCount',
            'completedCount',
            'todayBookings',
            'recentBookings'
        ));
    }
}
