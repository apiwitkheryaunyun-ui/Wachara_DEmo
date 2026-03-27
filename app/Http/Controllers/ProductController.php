<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('category')->active();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        if ($cat = $request->get('category_id')) {
            $query->where('category_id', $cat);
        }

        $products   = $query->orderBy('code')->paginate(20)->withQueryString();
        $categories = Category::all();

        return view('stock.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('stock.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'code'        => 'required|string|max:50|unique:products,code',
            'name'        => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'unit'        => 'required|string|max:50',
            'stock'       => 'required|integer|min:0',
            'min_stock'   => 'required|integer|min:0',
            'buy_price'   => 'required|numeric|min:0',
            'sell_price'  => 'required|numeric|min:0',
            'location'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        $product = Product::create($data);

        // Record initial stock movement if stock > 0
        if ($product->stock > 0) {
            StockMovement::create([
                'product_id'   => $product->id,
                'type'         => 'in',
                'quantity'     => $product->stock,
                'balance_after' => $product->stock,
                'note'         => 'สต็อกเริ่มต้น',
                'created_by'   => auth()->id(),
            ]);
        }

        return redirect()->route('stock.index')
            ->with('success', "เพิ่มสินค้า \"{$product->name}\" เรียบร้อยแล้ว");
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('stock.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'code'        => "required|string|max:50|unique:products,code,{$product->id}",
            'name'        => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'unit'        => 'required|string|max:50',
            'min_stock'   => 'required|integer|min:0',
            'buy_price'   => 'required|numeric|min:0',
            'sell_price'  => 'required|numeric|min:0',
            'location'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        $product->update($data);

        return redirect()->route('stock.index')
            ->with('success', "แก้ไขสินค้า \"{$product->name}\" เรียบร้อยแล้ว");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('stock.index')
            ->with('success', "ลบสินค้า \"{$product->name}\" เรียบร้อยแล้ว");
    }
}
