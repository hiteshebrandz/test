<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display all products on the dashboard.
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $products = Product::with('user')->get();
        } else {
            $products = Product::where('user_id', auth()->id())->get();
        }

        return view('dashboard', compact('products'));
    }


    /**
     * Store a new product in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product = new Product($request->only(['name', 'price', 'quantity']));
        $product->user_id = auth()->id();
        $product->save();

        return redirect()->back()->with('success', 'Product added successfully!');
    }


    /**
     * Update an existing product.
     */
    private function authorizeUser(Product $product)
    {
        if (auth()->user()->role !== 'admin' && $product->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function edit(Product $product)
    {
        $this->authorizeUser($product);
        return view('edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeUser($product);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product->update($request->only(['name', 'price', 'quantity']));

        return redirect()->route('dashboard')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $this->authorizeUser($product);

        $product->delete();

        return redirect()->route('dashboard')->with('success', 'Product deleted successfully!');
    }

    /**
     * Delete a product.
     */
}
