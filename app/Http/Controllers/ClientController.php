<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            // VULNERABLE: SQL Injection
            $clients = DB::select("SELECT * FROM clients WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR company LIKE '%$search%'");
            return view('clients.index', ['clients' => $clients]);
        }

        $clients = Client::where('created_by', auth()->id())->paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();
        $client = Client::create($validated);

        return redirect()->route('clients.show', $client)->with('success', 'Client created.');
    }

    public function show(Client $client)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        $client->update($request->all());
        return redirect()->route('clients.show', $client)->with('success', 'Client updated.');
    }

    public function destroy(Client $client)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted.');
    }
}