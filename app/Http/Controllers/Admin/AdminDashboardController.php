<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\File;
use App\Models\ActivityLog;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalFiles = File::count();
        $totalActivities = ActivityLog::count();
        
        $recentUsers = User::latest()->take(5)->get();
        $recentProducts = Product::with('creator')->latest()->take(5)->get();
        $recentActivities = ActivityLog::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalFiles',
            'totalActivities',
            'recentUsers',
            'recentProducts',
            'recentActivities'
        ));
    }
}