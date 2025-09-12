<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Menampilkan halaman daftar semua supplier.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(10);
        return view('pages.admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Menampilkan form untuk membuat supplier baru.
     */
    public function create()
    {
        return view('pages.admin.suppliers.create');
    }

    /**
     * Menyimpan data supplier baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:suppliers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Supplier::create($request->all());

        return redirect()->route('admin.suppliers.index')
                         ->with('success', 'Supplier created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit data supplier.
     */
    public function edit(Supplier $supplier)
    {
        return view('pages.admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Memperbarui data supplier di database.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:suppliers,email,' . $supplier->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier->update($request->all());

        return redirect()->route('admin.suppliers.index')
                         ->with('success', 'Supplier updated successfully.');
    }

    /**
     * Menghapus data supplier dari database.
     */
    public function destroy(Supplier $supplier)
    {
        // Pengecekan jika supplier masih terhubung dengan produk
        if ($supplier->products()->count() > 0) {
            return redirect()->route('admin.suppliers.index')
                             ->with('error', 'Supplier cannot be deleted because it is associated with existing products.');
        }

        $supplier->delete();

        return redirect()->route('admin.suppliers.index')
                         ->with('success', 'Supplier deleted successfully.');
    }
}

