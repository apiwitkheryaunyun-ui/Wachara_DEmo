<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Invoice;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_products' => Product::active()->count(),
            'low_stock'      => Product::lowStock()->count(),
            'out_of_stock'   => Product::outOfStock()->count(),
            'unpaid_invoices'=> Invoice::unpaid()->count(),
            'total_revenue'  => Invoice::paid()->sum('total'),
        ];

        $lowStockProducts = Product::with('category')
            ->where('stock', '<=', \DB::raw('min_stock'))
            ->orderBy('stock')
            ->limit(8)
            ->get();

        $recentInvoices = Invoice::latest('invoice_date')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'lowStockProducts', 'recentInvoices'));
    }
}
