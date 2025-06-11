<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() 
    {
        $products = Product::all();
        $title = 'Product';

        return view('product.index', [
            'products' => $products,
            'title' => $title
        ]);
    }

    public function create() 
    {
        return view('product.create', ['title' => 'Create Product']);
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'description' => 'required|string'
        ]);

        Product::create($validated);

        return redirect('/app/product')->with('success', 'New product successfully added!');
    }
}
