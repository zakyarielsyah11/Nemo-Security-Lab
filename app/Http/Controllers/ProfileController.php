<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'bio' => 'nullable|string|max:1000',
            'department' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        auth()->user()->update($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_profile',
            'details' => 'Updated profile information',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updateAvatar(Request $request)
    {
        // Vulnerable: Hanya validasi ukuran, tidak validasi tipe file
        $request->validate([
            'avatar' => 'required|file|max:2048',
        ]);

        $user = auth()->user();
        
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        return back()->with('success', 'Avatar updated successfully.');
    }

    public function updateAvatarFromUrl(Request $request)
    {
        $request->validate([
            'avatar_url' => 'required|url',
        ]);

        $url = $request->avatar_url;
        $user = auth()->user();

        try {
            // SSRF: Tidak ada validasi URL internal
            // Bisa akses http://127.0.0.1, http://169.254.169.254, dll
            $contents = file_get_contents($url);
            
            if ($contents === false) {
                return back()->withErrors(['avatar_url' => 'Failed to download image from URL']);
            }

            $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
            if (empty($extension)) {
                $extension = 'jpg';
            }

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $filename = 'avatars/' . uniqid() . '.' . $extension;
            Storage::disk('public')->put($filename, $contents);
            
            $user->update(['avatar' => $filename]);

            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'update_avatar_url',
                'details' => 'Updated avatar from URL: ' . $url,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return back()->with('success', 'Avatar updated from URL successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['avatar_url' => 'Failed to process URL: ' . $e->getMessage()]);
        }
    }
}