<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function stockInForm(): View
    {
        $products = Product::active()->orderBy('code')->get();
        $recent   = StockMovement::with('product')->stockIn()
                        ->latest()->limit(10)->get();
        return view('stock.stock-in', compact('products', 'recent'));
    }

    public function stockIn(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'unit_price' => 'nullable|numeric|min:0',
            'supplier'   => 'nullable|string|max:255',
            'note'       => 'nullable|string',
        ]);

        DB::transaction(function () use ($data) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);
            $product->increment('stock', $data['quantity']);

            StockMovement::create([
                'product_id'   => $product->id,
                'type'         => 'in',
                'quantity'     => $data['quantity'],
                'balance_after' => $product->fresh()->stock,
                'unit_price'   => $data['unit_price'] ?? null,
                'supplier'     => $data['supplier'] ?? null,
                'note'         => $data['note'] ?? null,
                'created_by'   => auth()->id(),
            ]);
        });

        return back()->with('success', "รับสินค้าเข้าสต็อก {$data['quantity']} ชิ้น เรียบร้อยแล้ว");
    }

    public function stockOutForm(): View
    {
        $products = Product::active()->where('stock', '>', 0)->orderBy('code')->get();
        $recent   = StockMovement::with('product')->stockOut()
                        ->latest()->limit(10)->get();
        return view('stock.stock-out', compact('products', 'recent'));
    }

    public function stockOut(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'requester'  => 'nullable|string|max:255',
            'department' => 'nullable|string|max:100',
            'note'       => 'nullable|string',
        ]);

        DB::transaction(function () use ($data) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);

            if ($product->stock < $data['quantity']) {
                throw new \Exception("สต็อกไม่เพียงพอ (คงเหลือ: {$product->stock})");
            }

            $product->decrement('stock', $data['quantity']);

            StockMovement::create([
                'product_id'   => $product->id,
                'type'         => 'out',
                'quantity'     => $data['quantity'],
                'balance_after' => $product->fresh()->stock,
                'requester'    => $data['requester'] ?? null,
                'department'   => $data['department'] ?? null,
                'note'         => $data['note'] ?? null,
                'created_by'   => auth()->id(),
            ]);
        });

        return back()->with('success', "เบิกสินค้าออก {$data['quantity']} ชิ้น เรียบร้อยแล้ว");
    }

    public function history(Request $request): View
    {
        $query = StockMovement::with('product');

        if ($pid = $request->get('product_id')) {
            $query->where('product_id', $pid);
        }
        if ($type = $request->get('type')) {
            $query->where('type', $type);
        }
        if ($from = $request->get('from')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->get('to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        $movements = $query->latest()->paginate(30)->withQueryString();
        $products  = Product::orderBy('code')->get();

        return view('stock.history', compact('movements', 'products'));
    }
}
