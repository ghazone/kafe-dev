<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        $total = Product::count();
        return view('admin.home', compact('data'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'price' => 'required',
        ]);

        $data = Product::create($validation);

        if ($data) {
            session()->flash('success', 'Product added successfully');
            return redirect(route('admin.product.index'));
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect(route('admin.product.create'));
        }
    }
}
