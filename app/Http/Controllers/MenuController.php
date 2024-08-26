<?php

namespace App\Http\Controllers;

use App\Models\Menu; // Pastikan ini sesuai dengan model yang Anda gunakan
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Mengambil semua menu dan mengirimkannya ke view
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        // Menampilkan form untuk membuat menu baru
        return view('menus.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Menyimpan menu baru
        Menu::create($request->all());

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit(Menu $menu)
    {
        // Menampilkan form untuk mengedit menu
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Memperbarui menu
        $menu->update($request->all());

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        // Menghapus menu
        $menu->delete();

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}
