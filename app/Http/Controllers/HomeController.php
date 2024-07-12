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
        // Ambil tanggal awal dan akhir bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Hitung jumlah transaksi bulan ini
        $transactionsThisMonth = Transaction::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        // Hitung jumlah total transaksi, total gros, dan total user
        $transactions = Transaction::count();
        $user = User::count();
        $grosreceive = Transaction::sum('total_harga');

        // Kirim data ke view
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