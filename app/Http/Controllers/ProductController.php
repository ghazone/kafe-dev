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
        return view('admin.product.home', compact('products', 'total'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'tittle' => 'required',
            'category' => 'required',
            'price' => 'required',
        ]);
        $data = Product::create($validation);
        if ($data) {
            session()->flash('succes', 'Product Add Successfully');
            return redirect(route('admin/product'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin.product/create'));
        }
    }
}
