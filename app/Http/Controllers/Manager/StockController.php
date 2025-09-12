<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function createIn()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('pages.manager.stock.create', [
            'type' => 'in',
            'products' => $products
        ]);
    }

    public function createOut()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('pages.manager.stock.create', [
            'type' => 'out',
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type == 'out' && $product->stock < $request->quantity) {
            return back()->with('error', 'Stock is not sufficient for this transaction.');
        }

        StockTransaction::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'type' => $request->type,
            'quantity' => $request->quantity,
            'date' => $request->date,
            'status' => 'completed',
            'notes' => $request->notes,
        ]);

        if ($request->type == 'in') {
            $product->increment('stock', $request->quantity);
        } else {
            $product->decrement('stock', $request->quantity);
        }

        $message = $request->type == 'in' ? 'Incoming stock recorded successfully.' : 'Outgoing stock recorded successfully.';
        
        return redirect()->route('manager.dashboard')->with('success', $message);
    }
}