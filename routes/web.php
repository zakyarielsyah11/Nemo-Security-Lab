<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileViewController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminFileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\VulnDbController;
use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Kerentanan: .env dan logs dapat diakses publik
Route::get('/env', function () {
    $envPath = base_path('.env');
    if (file_exists($envPath)) {
        return response()->file($envPath, ['Content-Type' => 'text/plain']);
    }
    abort(404);
})->name('env.public');

Route::get('/logs', function () {
    $logPath = storage_path('logs/laravel.log');
    if (file_exists($logPath)) {
        return response()->file($logPath, ['Content-Type' => 'text/plain']);
    }
    abort(404);
})->name('logs.public');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::post('/profile/avatar-url', [ProfileController::class, 'updateAvatarFromUrl'])->name('profile.avatar-url');
    
    // Products CRUD
    Route::resource('products', ProductController::class);
    
    // Projects CRUD
    Route::resource('projects', ProjectController::class);
    Route::post('/projects/{project}/comments', [ProjectController::class, 'storeComment'])->name('projects.comments.store');

    // Clients CRUD
    Route::resource('clients', ClientController::class);
    
    // Employees CRUD
    Route::resource('employees', EmployeeController::class);
    
    // Vulnerability Database CRUD
    Route::resource('vulndb', VulnDbController::class);
    
    // Network Tools
    Route::get('/tools', [ToolController::class, 'index'])->name('tools.index');
    Route::post('/tools/ping', [ToolController::class, 'ping'])->name('tools.ping');
    Route::post('/tools/traceroute', [ToolController::class, 'traceroute'])->name('tools.traceroute');
    
    // Files
    Route::get('/files', [FileController::class, 'index'])->name('files.index');
    Route::get('/files/upload', [FileController::class, 'uploadForm'])->name('files.upload');
    Route::post('/files/upload', [FileController::class, 'upload'])->name('files.store');
    
    // Import file dari URL (semua user) - letakkan sebelum route parameter {file}
    Route::post('/files/import-url', [FileController::class, 'importFromUrl'])->name('files.import-url');
    
    Route::get('/files/{file}', [FileController::class, 'show'])->name('files.show');
    Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
    
    // File Viewer
    Route::get('/files/{file}/view', [FileViewController::class, 'view'])->name('files.view');
    // LFI vulnerability (dapat diakses tanpa login jika route dipindah ke public, tapi sementara di auth)
    Route::get('/lfi', [FileViewController::class, 'viewByPath'])->name('lfi.view');
    
    // Import
    Route::get('/import', [ImportController::class, 'index'])->name('import.index');
    Route::post('/import/users', [ImportController::class, 'importUsers'])->name('import.users');
    Route::post('/import/products', [ImportController::class, 'importProducts'])->name('import.products');
    
    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // User management
        Route::resource('users', AdminUserController::class);
        
        // File management
        Route::get('/files', [AdminFileController::class, 'index'])->name('files.index');
        Route::post('/files/import-url', [AdminFileController::class, 'importFromUrl'])->name('files.import-url');
    });
});