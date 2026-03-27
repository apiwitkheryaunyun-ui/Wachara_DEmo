<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Invoice::query();

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('invoice_no', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }

        $invoices = $query->latest('invoice_date')->paginate(20)->withQueryString();

        $summary = [
            'total'   => Invoice::count(),
            'paid'    => Invoice::paid()->sum('total'),
            'unpaid'  => Invoice::unpaid()->sum('total'),
            'overdue' => Invoice::overdue()->count(),
        ];

        return view('invoices.index', compact('invoices', 'summary'));
    }

    public function create(): View
    {
        $products   = Product::active()->orderBy('code')->get();
        $invoiceNo  = Invoice::generateInvoiceNo();
        return view('invoices.create', compact('products', 'invoiceNo'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'invoice_no'       => 'required|string|max:100|unique:invoices,invoice_no',
            'customer_name'    => 'required|string|max:255',
            'customer_address' => 'nullable|string',
            'customer_tel'     => 'nullable|string|max:50',
            'customer_email'   => 'nullable|email|max:255',
            'invoice_date'     => 'required|date',
            'due_date'         => 'required|date|after_or_equal:invoice_date',
            'vat_rate'         => 'required|numeric|min:0|max:100',
            'discount'         => 'nullable|numeric|min:0',
            'note'             => 'nullable|string',
            'status'           => 'required|in:draft,sent',
            'items'            => 'required|array|min:1',
            'items.*.product_id'  => 'nullable|exists:products,id',
            'items.*.product_name'=> 'required|string|max:255',
            'items.*.quantity'    => 'required|integer|min:1',
            'items.*.unit_price'  => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($data) {
            $subtotal = collect($data['items'])->sum(fn($i) => $i['quantity'] * $i['unit_price']);
            $vatRate  = $data['vat_rate'];
            $vatAmt   = $subtotal * ($vatRate / 100);
            $discount = $data['discount'] ?? 0;
            $total    = $subtotal + $vatAmt - $discount;

            $invoice = Invoice::create([
                'invoice_no'       => $data['invoice_no'],
                'customer_name'    => $data['customer_name'],
                'customer_address' => $data['customer_address'] ?? null,
                'customer_tel'     => $data['customer_tel'] ?? null,
                'customer_email'   => $data['customer_email'] ?? null,
                'invoice_date'     => $data['invoice_date'],
                'due_date'         => $data['due_date'],
                'subtotal'         => $subtotal,
                'vat_rate'         => $vatRate,
                'vat_amount'       => $vatAmt,
                'discount'         => $discount,
                'total'            => $total,
                'status'           => $data['status'],
                'note'             => $data['note'] ?? null,
                'created_by'       => auth()->id(),
            ]);

            foreach ($data['items'] as $i => $item) {
                InvoiceItem::create([
                    'invoice_id'   => $invoice->id,
                    'product_id'   => $item['product_id'] ?? null,
                    'product_name' => $item['product_name'],
                    'description'  => $item['description'] ?? null,
                    'quantity'     => $item['quantity'],
                    'unit_price'   => $item['unit_price'],
                    'total'        => $item['quantity'] * $item['unit_price'],
                    'sort_order'   => $i,
                ]);
            }
        });

        return redirect()->route('invoices.index')
            ->with('success', "สร้าง Invoice {$data['invoice_no']} เรียบร้อยแล้ว");
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load('items.product');
        return view('invoices.show', compact('invoice'));
    }

    public function updateStatus(Request $request, Invoice $invoice): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'required|in:draft,sent,paid,overdue,cancelled',
        ]);

        $invoice->status = $data['status'];
        if ($data['status'] === Invoice::STATUS_PAID) {
            $invoice->paid_at = now();
        }
        $invoice->save();

        return back()->with('success', 'อัปเดตสถานะ Invoice เรียบร้อยแล้ว');
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->delete();
        return redirect()->route('invoices.index')
            ->with('success', "ลบ Invoice {$invoice->invoice_no} เรียบร้อยแล้ว");
    }
}
