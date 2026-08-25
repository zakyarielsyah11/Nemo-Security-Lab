<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            // VULNERABLE: SQL Injection
            $products = DB::select("SELECT p.*, u.name as creator_name FROM products p LEFT JOIN users u ON p.created_by = u.id WHERE p.title LIKE '%$search%' OR p.description LIKE '%$search%' OR p.category LIKE '%$search%' OR p.sku LIKE '%$search%'");
            return view('products.index', ['products' => $products]);
        }

        $products = Product::with('creator')->where('created_by', auth()->id())->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
            'status' => 'required|in:active,inactive,draft',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['sku'] = 'SKU-' . strtoupper(uniqid());

        $product = Product::create($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_product',
            'details' => 'Created product: ' . $product->title,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('products.show', $product)
                        ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
            'status' => 'required|in:active,inactive,draft',
        ]);

        $product->update($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_product',
            'details' => 'Updated product ID: ' . $product->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('products.show', $product)
                        ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        $product->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_product',
            'details' => 'Deleted product ID: ' . $product->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()->route('products.index')
                        ->with('success', 'Product deleted successfully.');
    }
}