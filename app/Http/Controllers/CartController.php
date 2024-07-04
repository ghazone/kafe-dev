<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Misalnya Anda memiliki data cart di session
        $cart = session()->get('cart', []);

        return view('cart', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        $productId = $request->get('productId');
        $action = $request->get('action');

        $cart = session()->get('cart');

        if ($action == 'add') {
            $cart[$productId]['quantity']++;
        } elseif ($action == 'remove') {
            $cart[$productId]['quantity']--;
            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            }
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }
}
    