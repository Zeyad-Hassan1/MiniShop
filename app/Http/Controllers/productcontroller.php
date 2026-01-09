<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
class productcontroller extends Controller
{
    public function index()
    {
        $products = products::all();
        return view('products.index', compact('products'));
    }
    public function show($id)
    {
        $product = products::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
