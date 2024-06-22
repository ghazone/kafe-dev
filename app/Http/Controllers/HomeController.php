<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        // Mengambil semua data menu
        $menus = Menu::all();

        // Mengirimkan data ke view admin.product.menu
        return view('admin.product.menu', compact('menus'));
    }
}
