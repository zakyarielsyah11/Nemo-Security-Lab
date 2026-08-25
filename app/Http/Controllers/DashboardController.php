<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\File;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Statistik untuk user
        $totalProducts = Product::where('created_by', $user->id)->count();
        $totalFiles = File::where('uploaded_by', $user->id)->count();
        $totalActivities = ActivityLog::where('user_id', $user->id)->count();
        
        // Produk terbaru
        $recentProducts = Product::where('created_by', $user->id)
                                ->latest()
                                ->take(5)
                                ->get();
        
        // File terbaru
        $recentFiles = File::where('uploaded_by', $user->id)
                          ->latest()
                          ->take(5)
                          ->get();
        
        // Aktivitas terbaru
        $recentActivities = ActivityLog::where('user_id', $user->id)
                                      ->latest()
                                      ->take(10)
                                      ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalFiles',
            'totalActivities',
            'recentProducts',
            'recentFiles',
            'recentActivities'
        ));
    }
}