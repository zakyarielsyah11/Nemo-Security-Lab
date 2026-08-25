<?php

namespace App\Http\Controllers;

use App\Models\ToolLog;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        return view('tools.index');
    }

    public function ping(Request $request)
    {
        $target = $request->input('target');
        
        // VULNERABLE: OS Command Injection
        $output = shell_exec("ping -c 4 " . $target);
        
        // Simpan log
        ToolLog::create([
            'user_id' => auth()->id(),
            'tool' => 'ping',
            'target' => $target,
            'output' => $output,
        ]);

        return view('tools.result', [
            'tool' => 'ping',
            'target' => $target,
            'output' => $output,
        ]);
    }

    public function traceroute(Request $request)
    {
        $target = $request->input('target');
        
        // VULNERABLE: OS Command Injection
        $output = shell_exec("traceroute " . $target);
        
        // Simpan log
        ToolLog::create([
            'user_id' => auth()->id(),
            'tool' => 'traceroute',
            'target' => $target,
            'output' => $output,
        ]);

        return view('tools.result', [
            'tool' => 'traceroute',
            'target' => $target,
            'output' => $output,
        ]);
    }
}