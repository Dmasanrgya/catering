<?php

namespace App\Http\Controllers;

use App\Models\Menu; // Pastikan ini sesuai dengan model yang Anda gunakan
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        // Aturan validasi dan pesan kesalahan
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('menus', 'name') // Pastikan nama unik di tabel menus
            ],
            'description' => 'nullable|string|max:255',
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'name.unique' => 'Nama menu sudah ada.',
            'description.nullable' => 'Deskripsi tidak wajib diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.max' => 'Deskripsi maksimal 255 karakter.',
        ];

        // Validasi input
        $validatedData = $request->validate($rules, $messages);

        // Set nilai default untuk description jika tidak diisi
        $validatedData['description'] = $validatedData['description'] ?? '-';

        // Menyimpan menu baru dengan data yang sudah divalidasi
        Menu::create($validatedData);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }


    public function edit(Menu $menu)
    {
        // Menampilkan form untuk mengedit menu
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('menus', 'name')->ignore($menu->id) // Memastikan nama unik, kecuali untuk menu ini
            ],
            'description' => 'nullable|string|max:255',
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'name.unique' => 'Nama menu sudah ada.',
            'description.nullable' => 'Deskripsi tidak wajib diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.max' => 'Deskripsi maksimal 255 karakter.',
        ];

        // Validasi input
        $validatedData = $request->validate($rules, $messages);

        // Memperbarui menu dengan data yang sudah divalidasi
        $menu->update($validatedData);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui.');
    }
    public function destroy(Menu $menu)
    {
        // Menghapus menu
        $menu->delete();

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('menus.index')->with('success', 'Menu deleted sucses.');
    }
}
