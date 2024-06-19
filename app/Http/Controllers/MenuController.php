<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Menu::orderBy('Nama_menu', 'asc')->get();
        return view("todo.Umenu", ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:2',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|min:2'
        ]);

        $data = [
            'Nama_menu' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi')
        ];

        Menu::create($data);

        return redirect()->route('menu')->with('success', 'Berhasil Tambah Menu');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|min:2',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|min:2'
        ]);

        $data = [
            'Nama_menu' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi')
        ];

        Menu::where('id_menu', $id)->update($data);

        return redirect()->route('menu')->with('success', 'Berhasil Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Menu::where('id_menu', $id)->delete();

        return redirect()->route('menu')->with('success', 'Berhasil delete');
    }
}
