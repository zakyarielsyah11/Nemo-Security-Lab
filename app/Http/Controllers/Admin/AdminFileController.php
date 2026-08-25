<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFileController extends Controller
{
    public function index(Request $request)
    {
        $query = File::with('uploader');

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $query->where('original_name', 'LIKE', "%{$request->search}%");
        }

        $files = $query->latest()->paginate(20);

        return view('admin.files.index', compact('files'));
    }

    public function importFromUrl(Request $request)
    {
        $request->validate([
            'file_url' => 'required|url',
            'description' => 'nullable|string|max:255',
        ]);

        $url = $request->file_url;

        try {
            // SSRF: Tidak ada validasi URL internal
            $contents = file_get_contents($url);
            
            if ($contents === false) {
                return back()->withErrors(['file_url' => 'Failed to download file from URL']);
            }

            $originalName = basename(parse_url($url, PHP_URL_PATH));
            if (empty($originalName)) {
                $originalName = 'downloaded_file.txt';
            }

            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $storedName = time() . '_' . uniqid() . '.' . $extension;
            
            $path = 'files/' . $storedName;
            Storage::disk('public')->put($path, $contents);

            $mimeType = Storage::disk('public')->mimeType($path);
            $fileSize = strlen($contents);

            $file = File::create([
                'original_name' => $originalName,
                'stored_name' => $storedName,
                'mime_type' => $mimeType,
                'file_size' => $fileSize,
                'path' => $path,
                'uploaded_by' => auth()->id(),
                'description' => $request->description,
                'is_public' => $request->has('is_public') ? true : false,
            ]);

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'import_file_url',
                'details' => 'Imported file from URL: ' . $url,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->route('files.show', $file)
                            ->with('success', 'File imported from URL successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['file_url' => 'Failed to process URL: ' . $e->getMessage()]);
        }
    }
}