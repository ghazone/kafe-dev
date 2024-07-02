<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Transaction;

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
        // Handle the transaction storage logic here
        // ...

        session()->forget('cart');
        return redirect()->route('admin.transaction.cart')->with('success', 'Transaction completed successfully!');
    }
}
