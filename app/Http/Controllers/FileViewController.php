<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileViewController extends Controller
{
    public function view(File $file)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        $content = Storage::disk('public')->get($file->path);
        return view('files.view', compact('file', 'content'));
    }

    // LFI via parameter path (tanpa autentikasi ketat)
    public function viewByPath(Request $request)
    {
        $path = $request->input('path');
        if (empty($path)) {
            abort(400, 'Path parameter required');
        }
        
        // VULNERABLE: Local File Inclusion
        // Tidak ada sanitasi, bisa akses file apa pun di server
        $fullPath = $path;
        if (file_exists($fullPath)) {
            $content = file_get_contents($fullPath);
            return response($content, 200)->header('Content-Type', 'text/plain');
        }
        
        abort(404, 'File not found');
    }
}