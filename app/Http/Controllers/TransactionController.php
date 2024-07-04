<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
<<<<<<< HEAD
use App\Models\Pesanan;
use App\Models\Transaction;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
=======
use App\Models\Transaction;
>>>>>>> 3bdad5e16c5ebd2ac7d461a2baa4249a21db6f9f

class TransactionController extends Controller
{
    // app/Http/Controllers/TransactionController.php

    public function index(Request $request)
    {
        $menus = Menu::all(); // Inisialisasi $menus di luar blok kondisional

        if ($request->has('search')) {
            $searchTerm = $request->input('term');
            $data = Menu::where('Nama_menu', 'like',
                '%' . $searchTerm . '%'
            )->get();
        } else {
            echo "tidak ada"; // Jika tidak ada pencarian, ambil semua data
        }

        return view('admin.transaction.index', compact('menus'));
    }


    public function addToCart(Request $request)
    {

        $cart = session()->get('cart', []);
        // dd($cart);
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
        // Validasi input
        $request->validate([
            'total' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        // Ambil data dari session 'cart'
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('admin.transaction.cart')->with('error', 'Cart is empty');
        }

        // Debugging
        // dd($request->all());

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_harga' => $request->input('total'),
            'payment_method' => $request->input('payment_method'),
        ]);

        $transactionId = $transaction->id;

        // Iterasi melalui setiap item di cart dan simpan ke database
        foreach ($cart as $id => $item) {
            Pesanan::create([
                'id_menu' => $item['id'],
                'jumlah_pesanan' => $item['quantity'],
                'id_transaksi' => $transactionId,
            ]);
        }

        // Kosongkan keranjang setelah transaksi disimpan
        session()->forget('cart');

        // Redirect dengan pesan sukses
        return redirect()->route('admin.transaction.cart')->with('success', 'Transaction completed successfully!');
    }
}
