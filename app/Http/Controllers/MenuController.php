<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu; // Sesuaikan dengan nama model Anda

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.product.menu', compact('menus'));
    }

    public function store(Request $request)
    {
        // Validasi dan simpan data
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        Menu::create($request->all());

        return redirect()->route('menu')->with('success', 'Menu berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        // Validasi dan update data
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($request->all());

        return redirect()->route('menu')->with('success', 'Menu berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Hapus data
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menu')->with('success', 'Menu berhasil dihapus');
    }
}
