<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
=======

>>>>>>> 6ff38f29de466a23fed4bea30975c5723d3bf0fc

class TransactionController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $menus = Menu::all();
        return view('admin.transaction.index', compact('menus'));
=======
        $menus = Menu::all(); // Inisialisasi $menus di luar blok kondisional

        if ($request->has('term')) {
            $searchTerm = $request->input('term');
            $menus = Menu::where('Nama_menu', 'like', '%' . $searchTerm . '%')->get();
        } else {
            $menus = Menu::all(); // Jika tidak ada pencarian, ambil semua data
        }
            
            return view('admin.transaction.index', compact('menus'));
>>>>>>> 6ff38f29de466a23fed4bea30975c5723d3bf0fc
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);
<<<<<<< HEAD

=======
         dd($cart);
>>>>>>> 6ff38f29de466a23fed4bea30975c5723d3bf0fc
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->id] = [
                "id" => $request->id,
                "name" => $request->name,
                "price" => $request->price,
                "quantity" => $request->quantity
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => 'Item added to cart successfully!']);
    }

    public function removeFromCart(Request $request)
    {
        $id = $request->input('id');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return response()->json(['message' => 'Item removed from cart', 'cart' => $cart]);
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);

        return view('admin.transaction.cart', compact('cart'));
    }

    public function store(Request $request)
    {
        // Validasi data sebelum menyimpan transaksi
        $request->validate([
            'total' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        // Ambil data dari session 'cart'
        $cart = session()->get('cart', []);

        // Debugging data request
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        try {
            // Hitung total harga dari item di keranjang
            $totalHarga = array_reduce($cart, function ($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);

            // Simpan transaksi ke dalam database
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'total_harga' => $totalHarga,
                'payment_method' => $request->input('payment_method'),
            ]);

            $transactionId = $transaction->id;

            // Iterasi melalui setiap item di cart dan simpan pesanan ke database
            foreach ($cart as $id => $item) {
                Pesanan::create([
                    'id_menu' => $item['id'],
                    'jumlah_pesanan' => $item['quantity'],
                    'id_transaksi' => $transactionId,
                ]);
            }

            // Kosongkan keranjang setelah transaksi selesai
            session()->forget('cart');

            // Redirect ke halaman konfirmasi
            return redirect()->route('transaction.confirmation')->with('success', 'Transaction completed successfully!');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tangani dengan memberikan pesan error
            return redirect()->back()->with('error', 'Failed to complete transaction: ' . $e->getMessage());
        }
    }

    public function confirmation()
    {
        return view('admin.transaction.confirmation');
    }
}
