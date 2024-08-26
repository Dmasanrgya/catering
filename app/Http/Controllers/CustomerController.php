<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        //
        $customers = Customer::paginate(10); 
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        //
        return view('customers.create');
    }
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:12|unique:customers,phone',
            'address' => 'required|string',
        ],[
            'email.unique' => 'email sudah ada',
            'phone.unique' => 'no telepon sudah ada'
        ]);


        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ],[
            'email.unique' => 'email sudah ada',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($validated);

       return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan.');

    }

    public function destroy(string $id)
    {
        // Temukan pelanggan berdasarkan ID
        $customer = Customer::findOrFail($id);

        // Hapus pelanggan
        $customer->delete();

        // Redirect kembali ke daftar pelanggan dengan pesan sukses
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
