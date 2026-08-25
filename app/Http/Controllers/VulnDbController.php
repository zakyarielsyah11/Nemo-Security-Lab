<?php

namespace App\Http\Controllers;

use App\Models\VulnDb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VulnDbController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            // VULNERABLE: SQL Injection
            $vulns = DB::select("SELECT * FROM vuln_dbs WHERE name LIKE '%$search%' OR category LIKE '%$search%' OR severity LIKE '%$search%'");
            return view('vulndb.index', ['vulns' => $vulns]);
        }

        $vulns = VulnDb::where('created_by', auth()->id())->paginate(10);
        return view('vulndb.index', compact('vulns'));
    }

    public function create()
    {
        return view('vulndb.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'severity' => 'required|in:low,medium,high,critical',
            'category' => 'nullable|string|max:100',
            'remediation' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();
        $vuln = VulnDb::create($validated);

        return redirect()->route('vulndb.show', $vuln)->with('success', 'Vulnerability added.');
    }

    public function show(VulnDb $vuln)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        return view('vulndb.show', compact('vuln'));
    }

    public function edit(VulnDb $vuln)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        return view('vulndb.edit', compact('vuln'));
    }

    public function update(Request $request, VulnDb $vuln)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        $vuln->update($request->all());
        return redirect()->route('vulndb.show', $vuln)->with('success', 'Vulnerability updated.');
    }

    public function destroy(VulnDb $vuln)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        $vuln->delete();
        return redirect()->route('vulndb.index')->with('success', 'Vulnerability deleted.');
    }
}