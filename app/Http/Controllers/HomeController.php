<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function dashboard()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $transactionsThisMonth = Transaction::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        $transactions = Transaction::count();
        $user = User::count();
        $grosreceive = Transaction::sum('total_harga');

        

        return view('admin.dashboard', compact('transactionsThisMonth', 'transactions', 'grosreceive', 'user'));
    }

    public function homepage()
    {
        return view('user.hompage');
    }

    public function index()
    {
        // Mengambil semua data menu
        $menus = Menu::all();

        // Mengirimkan data ke view admin.product.menu
        return view('admin.product.menu', compact('menus'));
    }
}