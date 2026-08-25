<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $query = File::with('uploader');
        
        if (auth()->user()->role !== 'admin') {
            $query->where('uploaded_by', auth()->id());
        }

        if ($request->has('type') && !empty($request->type)) {
            $query->where('mime_type', 'LIKE', "%{$request->type}%");
        }

        if ($request->has('search') && !empty($request->search)) {
            $query->where('original_name', 'LIKE', "%{$request->search}%");
        }

        $files = $query->latest()->paginate(15);

        return view('files.index', compact('files'));
    }

    public function uploadForm()
    {
        return view('files.upload');
    }

    public function upload(Request $request)
    {
        // VULNERABLE: Hanya validasi ukuran, tidak validasi tipe file
        $request->validate([
            'file' => 'required|file|max:20480',
            'description' => 'nullable|string|max:255',
        ]);

        $file = $request->file('file');
        
        $storedName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('files', $storedName, 'public');

        $fileRecord = File::create([
            'original_name' => $file->getClientOriginalName(),
            'stored_name' => $storedName,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'path' => $path,
            'uploaded_by' => auth()->id(),
            'description' => $request->description,
            'is_public' => $request->has('is_public') ? true : false,
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'upload_file',
            'details' => 'Uploaded file: ' . $file->getClientOriginalName(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('files.show', $fileRecord)
                        ->with('success', 'File uploaded successfully.');
    }

    // Tambahan: import file dari URL untuk semua user
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

    public function show(File $file)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        return view('files.show', compact('file'));
    }

    public function download(File $file)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        return Storage::disk('public')->download($file->path, $file->original_name);
    }

    public function destroy(File $file)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        Storage::disk('public')->delete($file->path);
        $file->delete();

        return redirect()->route('files.index')
                        ->with('success', 'File deleted successfully.');
    }
}