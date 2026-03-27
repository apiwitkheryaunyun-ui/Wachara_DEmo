<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpaApiController extends Controller
{
    public function bootstrap(Request $request): JsonResponse
    {
        $categories = Category::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->pluck('name')
            ->values();

        $products = Product::query()
            ->with('category')
            ->orderBy('code')
            ->get()
            ->map(fn (Product $p) => $this->mapProduct($p))
            ->values();

        $invoices = Invoice::query()
            ->with(['items' => fn ($q) => $q->orderBy('sort_order')])
            ->latest('invoice_date')
            ->get()
            ->map(fn (Invoice $i) => $this->mapInvoice($i))
            ->values();

        $movements = StockMovement::query()
            ->with(['product', 'createdBy'])
            ->latest('created_at')
            ->limit(300)
            ->get()
            ->map(fn (StockMovement $m) => $this->mapMovement($m))
            ->values();

        return response()->json([
            'user' => [
                'id'       => (string) $request->user()->id,
                'username' => $request->user()->username,
                'name'     => $request->user()->name,
                'role'     => $request->user()->role,
            ],
            'categories' => $categories,
            'products' => $products,
            'invoices' => $invoices,
            'stockMovements' => $movements,
        ]);
    }

    public function storeProduct(Request $request): JsonResponse
    {
        $data = $request->validate([
            'code'      => 'required|string|max:50|unique:products,code',
            'name'      => 'required|string|max:255',
            'cat'       => 'required|string|max:100',
            'unit'      => 'required|string|max:50',
            'stock'     => 'required|integer|min:0',
            'minStock'  => 'required|integer|min:0',
            'buyPrice'  => 'required|numeric|min:0',
            'sellPrice' => 'required|numeric|min:0',
            'location'  => 'nullable|string|max:100',
            'desc'      => 'nullable|string',
            'status'    => 'required|in:active,inactive',
        ]);

        $product = DB::transaction(function () use ($request, $data) {
            $category = Category::firstOrCreate(['name' => $data['cat']], ['description' => null]);

            $product = Product::create([
                'code'        => $data['code'],
                'name'        => $data['name'],
                'category_id' => $category->id,
                'unit'        => $data['unit'],
                'stock'       => $data['stock'],
                'min_stock'   => $data['minStock'],
                'buy_price'   => $data['buyPrice'],
                'sell_price'  => $data['sellPrice'],
                'location'    => $data['location'] ?? null,
                'description' => $data['desc'] ?? null,
                'status'      => $data['status'],
            ]);

            if ($product->stock > 0) {
                StockMovement::create([
                    'product_id'    => $product->id,
                    'type'          => 'in',
                    'quantity'      => $product->stock,
                    'balance_after' => $product->stock,
                    'note'          => 'สต็อกเริ่มต้น',
                    'created_by'    => $request->user()->id,
                ]);
            }

            return $product;
        });

        return response()->json([
            'message' => 'เพิ่มสินค้าเรียบร้อยแล้ว',
            'product' => $this->mapProduct($product->fresh('category')),
        ]);
    }

    public function updateProduct(Request $request, Product $product): JsonResponse
    {
        $data = $request->validate([
            'code'      => 'required|string|max:50|unique:products,code,' . $product->id,
            'name'      => 'required|string|max:255',
            'cat'       => 'required|string|max:100',
            'unit'      => 'required|string|max:50',
            'minStock'  => 'required|integer|min:0',
            'buyPrice'  => 'required|numeric|min:0',
            'sellPrice' => 'required|numeric|min:0',
            'location'  => 'nullable|string|max:100',
            'desc'      => 'nullable|string',
            'status'    => 'required|in:active,inactive',
        ]);

        $category = Category::firstOrCreate(['name' => $data['cat']], ['description' => null]);

        $product->update([
            'code'        => $data['code'],
            'name'        => $data['name'],
            'category_id' => $category->id,
            'unit'        => $data['unit'],
            'min_stock'   => $data['minStock'],
            'buy_price'   => $data['buyPrice'],
            'sell_price'  => $data['sellPrice'],
            'location'    => $data['location'] ?? null,
            'description' => $data['desc'] ?? null,
            'status'      => $data['status'],
        ]);

        return response()->json([
            'message' => 'แก้ไขสินค้าเรียบร้อยแล้ว',
            'product' => $this->mapProduct($product->fresh('category')),
        ]);
    }

    public function deleteProduct(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'message' => 'ลบสินค้าเรียบร้อยแล้ว',
        ]);
    }

    public function stockIn(Request $request): JsonResponse
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'unit_price' => 'nullable|numeric|min:0',
            'supplier'   => 'nullable|string|max:255',
            'note'       => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $data) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);
            $product->increment('stock', $data['quantity']);
            $product->refresh();

            StockMovement::create([
                'product_id'    => $product->id,
                'type'          => 'in',
                'quantity'      => $data['quantity'],
                'balance_after' => $product->stock,
                'unit_price'    => $data['unit_price'] ?? null,
                'supplier'      => $data['supplier'] ?? null,
                'note'          => $data['note'] ?? null,
                'created_by'    => $request->user()->id,
            ]);
        });

        return response()->json([
            'message' => 'รับสินค้าเข้าสต็อกเรียบร้อยแล้ว',
        ]);
    }

    public function stockOut(Request $request): JsonResponse
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'requester'  => 'nullable|string|max:255',
            'department' => 'nullable|string|max:100',
            'note'       => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($request, $data) {
                $product = Product::lockForUpdate()->findOrFail($data['product_id']);
                if ($product->stock < $data['quantity']) {
                    throw new \RuntimeException("สต็อกไม่เพียงพอ (คงเหลือ: {$product->stock})");
                }

                $product->decrement('stock', $data['quantity']);
                $product->refresh();

                StockMovement::create([
                    'product_id'    => $product->id,
                    'type'          => 'out',
                    'quantity'      => $data['quantity'],
                    'balance_after' => $product->stock,
                    'requester'     => $data['requester'] ?? null,
                    'department'    => $data['department'] ?? null,
                    'note'          => $data['note'] ?? null,
                    'created_by'    => $request->user()->id,
                ]);
            });
        } catch (\RuntimeException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

        return response()->json([
            'message' => 'เบิกสินค้าออกจากสต็อกเรียบร้อยแล้ว',
        ]);
    }

    public function storeInvoice(Request $request): JsonResponse
    {
        $data = $request->validate([
            'invoice_no'      => 'required|string|max:100|unique:invoices,invoice_no',
            'customer_name'   => 'required|string|max:255',
            'customer_address'=> 'nullable|string|max:255',
            'customer_tel'    => 'nullable|string|max:50',
            'customer_email'  => 'nullable|email|max:255',
            'invoice_date'    => 'required|date',
            'due_date'        => 'required|date|after_or_equal:invoice_date',
            'vat_rate'        => 'required|numeric|min:0|max:100',
            'discount'        => 'nullable|numeric|min:0',
            'note'            => 'nullable|string',
            'status'          => 'required|in:draft,sent',
            'items'           => 'required|array|min:1',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.description' => 'nullable|string',
        ]);

        $invoice = DB::transaction(function () use ($request, $data) {
            $subtotal = collect($data['items'])->sum(fn ($item) => $item['quantity'] * $item['unit_price']);
            $vatAmount = $subtotal * ($data['vat_rate'] / 100);
            $discount = $data['discount'] ?? 0;

            $invoice = Invoice::create([
                'invoice_no'       => $data['invoice_no'],
                'customer_name'    => $data['customer_name'],
                'customer_address' => $data['customer_address'] ?? null,
                'customer_tel'     => $data['customer_tel'] ?? null,
                'customer_email'   => $data['customer_email'] ?? null,
                'invoice_date'     => $data['invoice_date'],
                'due_date'         => $data['due_date'],
                'subtotal'         => $subtotal,
                'vat_rate'         => $data['vat_rate'],
                'vat_amount'       => $vatAmount,
                'discount'         => $discount,
                'total'            => $subtotal + $vatAmount - $discount,
                'status'           => $data['status'],
                'note'             => $data['note'] ?? null,
                'created_by'       => $request->user()->id,
            ]);

            foreach ($data['items'] as $index => $item) {
                InvoiceItem::create([
                    'invoice_id'   => $invoice->id,
                    'product_id'   => $item['product_id'] ?? null,
                    'product_name' => $item['product_name'],
                    'description'  => $item['description'] ?? null,
                    'quantity'     => $item['quantity'],
                    'unit_price'   => $item['unit_price'],
                    'total'        => $item['quantity'] * $item['unit_price'],
                    'sort_order'   => $index,
                ]);
            }

            return $invoice;
        });

        return response()->json([
            'message' => 'บันทึก Invoice เรียบร้อยแล้ว',
            'invoice' => $this->mapInvoice($invoice->load('items')),
        ]);
    }

    public function updateInvoiceStatus(Request $request, Invoice $invoice): JsonResponse
    {
        $data = $request->validate([
            'status' => 'required|in:draft,sent,paid,overdue,cancelled',
        ]);

        $invoice->status = $data['status'];
        if ($data['status'] === Invoice::STATUS_PAID) {
            $invoice->paid_at = now();
        }
        $invoice->save();

        return response()->json([
            'message' => 'อัปเดตสถานะ Invoice เรียบร้อยแล้ว',
        ]);
    }

    public function deleteInvoice(Invoice $invoice): JsonResponse
    {
        $invoice->delete();

        return response()->json([
            'message' => 'ลบ Invoice เรียบร้อยแล้ว',
        ]);
    }

    private function mapProduct(Product $p): array
    {
        return [
            'id'       => (string) $p->id,
            'code'     => $p->code,
            'name'     => $p->name,
            'cat'      => $p->category?->name ?? 'ไม่ระบุหมวด',
            'unit'     => $p->unit,
            'stock'    => (int) $p->stock,
            'minStock' => (int) $p->min_stock,
            'buyPrice' => (float) $p->buy_price,
            'sellPrice'=> (float) $p->sell_price,
            'location' => $p->location,
            'status'   => $p->status,
            'desc'     => $p->description,
        ];
    }

    private function mapInvoice(Invoice $i): array
    {
        return [
            'id'       => (string) $i->id,
            'no'       => $i->invoice_no,
            'customer' => $i->customer_name,
            'addr'     => $i->customer_address,
            'tel'      => $i->customer_tel,
            'email'    => $i->customer_email,
            'date'     => optional($i->invoice_date)->format('Y-m-d'),
            'due'      => optional($i->due_date)->format('Y-m-d'),
            'items'    => $i->items->map(fn (InvoiceItem $item) => [
                'pid'   => $item->product_id ? (string) $item->product_id : '',
                'name'  => $item->product_name,
                'qty'   => (int) $item->quantity,
                'price' => (float) $item->unit_price,
                'total' => (float) $item->total,
            ])->values(),
            'subtotal' => (float) $i->subtotal,
            'vat'      => (float) $i->vat_rate,
            'vatAmt'   => (float) $i->vat_amount,
            'discount' => (float) $i->discount,
            'total'    => (float) $i->total,
            'status'   => $i->status,
            'note'     => $i->note,
        ];
    }

    private function mapMovement(StockMovement $m): array
    {
        return [
            'date'    => optional($m->created_at)->format('Y-m-d H:i:s'),
            'pid'     => $m->product_id ? (string) $m->product_id : '',
            'pname'   => $m->product?->name ?? '-',
            'type'    => $m->type === 'adjustment' ? 'in' : $m->type,
            'qty'     => (int) $m->quantity,
            'balance' => (int) $m->balance_after,
            'user'    => $m->requester ?: ($m->createdBy?->name ?? 'ผู้ใช้ระบบ'),
            'note'    => $m->note ?? '',
        ];
    }
}
