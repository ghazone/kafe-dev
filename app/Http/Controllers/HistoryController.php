<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all(); // Ambil semua transaksi untuk ditampilkan di history
        return view('admin.product.history', compact('transactions'));
    }

    /**
     * Get details of a specific transaction.
     */
    public function showTransactionDetails($id)
    {
        $transaction = Transaction::with(['pesanan.menu'])->find($id);

        if (!$transaction) {
            return response()->json(['error' => 'Transaksi tidak ditemukan.'], 404);
        }

        return response()->json([
            'menu' => $transaction->pesanan->map(function ($pesanan) {
                return [
                    'nama_menu' => $pesanan->menu->Nama_menu,
                    'id_menu' => $pesanan->id_menu,
                    'jumlah_pesanan' => $pesanan->jumlah_pesanan,
                ];
            }),
            'total_harga' => $transaction->total_harga,
            'payment_method' => $transaction->payment_method,
        ]);
    }
}
