<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu; // Sesuaikan dengan nama model yang sesuai

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all(); // Gantikan dengan query sesuai kebutuhan Anda
        $menus = Menu::orderBy('Nama_menu', 'desc')->paginate(5);
        return view("admin.product.pesanan", ['menus' => $menus]);
    }

    // ... methods lainnya seperti create, store, show, edit, update, destroy
}