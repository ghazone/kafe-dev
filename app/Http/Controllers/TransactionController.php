<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::all();
        $menus = Menu::orderBy('Nama_menu', 'desc')->paginate(5);
        $transactions = Transaction::all(); // Inisialisasi $transactions

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $transactions = Transaction::where('user_id', 'like', '%' . $searchTerm . '%')
                ->orWhere('payment_method', 'like', '%' . $searchTerm . '%')
                ->get();
        }

        return view('admin.transaction.index', compact('menus', 'transactions'));
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
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
        $request->validate([
            'total' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('admin.transaction.cart')->with('error', 'Cart is empty');
        }

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_harga' => $request->input('total'),
            'payment_method' => $request->input('payment_method'),
        ]);

        foreach ($cart as $id => $item) {
            Pesanan::create([
                'id_menu' => $item['id'],
                'jumlah_pesanan' => $item['quantity'],
                'id_transaksi' => $transaction->id,
            ]);
        }

        session()->forget('cart');
        return redirect()->route('admin.transaction.success')->with('success', 'Pesanan Succes, pesanan anda sedang di buatkan!, Tunggu ');
    }

    public function success()
    {
        return view('admin.transaction.success');
    }

    public function confirmation()
    {
        return view('admin.transaction.confirmation');
    }
}