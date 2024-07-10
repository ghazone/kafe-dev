<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = auth()->user()->id;
        $transactions = Transaction::where('user_id', $auth)->get(); // Ambil semua transaksi untuk ditampilkan di history

        
        return view('admin.product.history', compact('transactions'));
    }


    /**
     * Get details of a specific transaction.
     */
    public function showTransactionDetails($id)
    {
        // Ambil detail transaksi hanya untuk user yang sedang login
        $transaction = Transaction::with(['pesanan.menu'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaksi tidak ditemukan atau anda tidak berhak mengakses.'], 404);
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
