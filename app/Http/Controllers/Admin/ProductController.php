<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua produk dengan relasi kategori dan supplier untuk efisiensi
        $products = Product::with(['category', 'supplier'])->latest()->paginate(10);
        return view('pages.admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('pages.admin.products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:product,sku',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'required|integer',
            'minimum_stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.create')->with('success', 'Product created successfully.');
    }

    public function edit(Product $products)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('pages.admin.products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $products)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:product,sku,' . $products->id,
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'required|integer',
            'minimum_stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($products->image && file_exists(storage_path('app/public/' . $products->image))) {
                unlink(storage_path('app/public/' . $products->image));
            }
            $data['image'] = $request->file('image')->store('product', 'public');
        }

        $products->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $products)
    {
        // Hapus gambar dari storage
        if ($products->image && file_exists(storage_path('app/public/' . $products->image))) {
            unlink(storage_path('app/public/' . $products->image));
        }
        
        $products->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
