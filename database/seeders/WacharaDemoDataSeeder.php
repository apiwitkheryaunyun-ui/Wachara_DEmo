<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WacharaDemoDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $admin = User::query()->where('username', env('ADMIN_USERNAME', 'admin'))->first();

            $categories = [
                ['name' => 'หลอดไฟ LED', 'sort_order' => 1],
                ['name' => 'โคมไฟและอุปกรณ์แสงสว่าง', 'sort_order' => 2],
                ['name' => 'สวิตช์และเต้ารับ', 'sort_order' => 3],
                ['name' => 'สายไฟและอุปกรณ์เดินสาย', 'sort_order' => 4],
                ['name' => 'เบรกเกอร์และตู้ไฟ', 'sort_order' => 5],
                ['name' => 'อุปกรณ์โรงงาน/ท่าเรือ', 'sort_order' => 6],
                ['name' => 'อุปกรณ์เซฟตี้ไฟฟ้า', 'sort_order' => 7],
            ];

            $categoryMap = [];
            foreach ($categories as $categoryData) {
                $category = Category::query()->updateOrCreate(
                    ['name' => $categoryData['name']],
                    [
                        'description' => null,
                        'sort_order' => $categoryData['sort_order'],
                    ]
                );
                $categoryMap[$category->name] = $category->id;
            }

            $products = [
                ['code' => 'P001', 'name' => 'หลอดไฟ LED Bulb 9W E27 แสงเดย์ไลท์', 'cat' => 'หลอดไฟ LED', 'unit' => 'หลอด', 'stock' => 120, 'min_stock' => 40, 'buy_price' => 45.00, 'sell_price' => 79.00, 'location' => 'L-A01', 'description' => 'เหมาะสำหรับบ้านและสำนักงาน'],
                ['code' => 'P002', 'name' => 'หลอดไฟ LED Tube T8 18W 120cm', 'cat' => 'หลอดไฟ LED', 'unit' => 'หลอด', 'stock' => 95, 'min_stock' => 30, 'buy_price' => 95.00, 'sell_price' => 149.00, 'location' => 'L-A02', 'description' => 'ทดแทนหลอดฟลูออเรสเซนต์'],
                ['code' => 'P003', 'name' => 'โคมไฟถนน LED 100W กันน้ำ IP65', 'cat' => 'โคมไฟและอุปกรณ์แสงสว่าง', 'unit' => 'ชุด', 'stock' => 18, 'min_stock' => 8, 'buy_price' => 1450.00, 'sell_price' => 2190.00, 'location' => 'L-B01', 'description' => 'เหมาะงานภายนอกและท่าเรือ'],
                ['code' => 'P004', 'name' => 'โคมไฮเบย์ LED 150W สำหรับโกดัง', 'cat' => 'โคมไฟและอุปกรณ์แสงสว่าง', 'unit' => 'ชุด', 'stock' => 9, 'min_stock' => 5, 'buy_price' => 1850.00, 'sell_price' => 2690.00, 'location' => 'L-B02', 'description' => 'ให้ความสว่างสูงสำหรับคลังสินค้า'],
                ['code' => 'P005', 'name' => 'สวิตช์ไฟ 1 ทาง 16A สีขาว', 'cat' => 'สวิตช์และเต้ารับ', 'unit' => 'ตัว', 'stock' => 210, 'min_stock' => 80, 'buy_price' => 28.00, 'sell_price' => 45.00, 'location' => 'E-C01', 'description' => 'มาตรฐาน มอก.'],
                ['code' => 'P006', 'name' => 'เต้ารับคู่ 3 ขา มีกราวด์', 'cat' => 'สวิตช์และเต้ารับ', 'unit' => 'ตัว', 'stock' => 160, 'min_stock' => 70, 'buy_price' => 35.00, 'sell_price' => 59.00, 'location' => 'E-C02', 'description' => 'รองรับปลั๊กไทย/สากล'],
                ['code' => 'P007', 'name' => 'สายไฟ THW 1x2.5 sq.mm (100m)', 'cat' => 'สายไฟและอุปกรณ์เดินสาย', 'unit' => 'ม้วน', 'stock' => 32, 'min_stock' => 12, 'buy_price' => 980.00, 'sell_price' => 1390.00, 'location' => 'E-D01', 'description' => 'ทองแดงแท้ ฉนวน PVC'],
                ['code' => 'P008', 'name' => 'สายไฟ VAF 2x2.5 sq.mm (100m)', 'cat' => 'สายไฟและอุปกรณ์เดินสาย', 'unit' => 'ม้วน', 'stock' => 25, 'min_stock' => 10, 'buy_price' => 1450.00, 'sell_price' => 1990.00, 'location' => 'E-D02', 'description' => 'งานเดินสายภายในอาคาร'],
                ['code' => 'P009', 'name' => 'MCB 1P 20A 6kA', 'cat' => 'เบรกเกอร์และตู้ไฟ', 'unit' => 'ตัว', 'stock' => 74, 'min_stock' => 25, 'buy_price' => 105.00, 'sell_price' => 169.00, 'location' => 'P-E01', 'description' => 'เซฟตี้เบรกเกอร์วงจรย่อย'],
                ['code' => 'P010', 'name' => 'ตู้คอนซูมเมอร์ยูนิต 8 ช่อง', 'cat' => 'เบรกเกอร์และตู้ไฟ', 'unit' => 'ตู้', 'stock' => 14, 'min_stock' => 6, 'buy_price' => 1150.00, 'sell_price' => 1690.00, 'location' => 'P-E02', 'description' => 'พร้อมรางและฝาครอบ'],
                ['code' => 'P011', 'name' => 'ไฟฉุกเฉิน LED 2 หัว 3W', 'cat' => 'อุปกรณ์เซฟตี้ไฟฟ้า', 'unit' => 'เครื่อง', 'stock' => 21, 'min_stock' => 10, 'buy_price' => 720.00, 'sell_price' => 1090.00, 'location' => 'S-F01', 'description' => 'แบตเตอรี่สำรองในตัว'],
                ['code' => 'P012', 'name' => 'ปลั๊กพ่วงอุตสาหกรรม 4 ช่อง 16A', 'cat' => 'อุปกรณ์โรงงาน/ท่าเรือ', 'unit' => 'ชุด', 'stock' => 11, 'min_stock' => 8, 'buy_price' => 480.00, 'sell_price' => 790.00, 'location' => 'S-F03', 'description' => 'เหมาะงานภาคสนามและท่าเรือ'],
            ];

            $productMap = [];
            foreach ($products as $productData) {
                $product = Product::query()->withTrashed()->firstOrNew([
                    'code' => $productData['code'],
                ]);
                $product->fill([
                    'name' => $productData['name'],
                    'category_id' => $categoryMap[$productData['cat']] ?? null,
                    'unit' => $productData['unit'],
                    'stock' => $productData['stock'],
                    'min_stock' => $productData['min_stock'],
                    'buy_price' => $productData['buy_price'],
                    'sell_price' => $productData['sell_price'],
                    'location' => $productData['location'],
                    'description' => $productData['description'],
                    'status' => 'active',
                ]);
                $product->save();
                if ($product->trashed()) {
                    $product->restore();
                }
                $productMap[$productData['code']] = $product->id;
            }

            $customers = [
                ['name' => 'บริษัท พอร์ต ลอจิสติกส์ เซอร์วิส จำกัด', 'address' => '88/12 ถ.ท่าเรือ แขวงคลองเตย กรุงเทพฯ 10110', 'phone' => '02-888-1234', 'email' => 'purchase@portlogistics.co.th'],
                ['name' => 'หจก. สมุทรเทรดดิ้งแอนด์ซัพพลาย', 'address' => '456 ถ.สุขุมวิท สมุทรปราการ', 'phone' => '02-777-5678', 'email' => 'buy@samuttrading.co.th'],
                ['name' => 'คุณศศิธร แสงสว่าง', 'address' => '789 ม.5 ต.บางเขน นนทบุรี', 'phone' => '081-234-5678', 'email' => 'sasithorn@gmail.com'],
                ['name' => 'บริษัท อีสเทิร์น พอร์ต เอ็นจิเนียริ่ง จำกัด', 'address' => '101 นิคมอุตสาหกรรม บางชัน', 'phone' => '02-999-0001', 'email' => 'it@easternport.co.th'],
                ['name' => 'โรงเรียน แหลมฉบังวิทยา', 'address' => '50 ถ.นวลจันทร์ กรุงเทพฯ 10230', 'phone' => '02-555-6789', 'email' => 'purchase@school.ac.th'],
            ];

            $customerMap = [];
            foreach ($customers as $customerData) {
                $customer = Customer::query()->updateOrCreate(
                    ['email' => $customerData['email']],
                    [
                        'name' => $customerData['name'],
                        'tax_id' => null,
                        'address' => $customerData['address'],
                        'phone' => $customerData['phone'],
                    ]
                );
                $customerMap[$customerData['email']] = $customer->id;
            }

            $invoices = [
                [
                    'invoice_no' => 'INV-2026-001',
                    'customer_email' => 'purchase@portlogistics.co.th',
                    'customer_name' => 'บริษัท พอร์ต ลอจิสติกส์ เซอร์วิส จำกัด',
                    'customer_address' => '88/12 ถ.ท่าเรือ แขวงคลองเตย กรุงเทพฯ 10110',
                    'customer_tel' => '02-888-1234',
                    'invoice_date' => '2026-02-15',
                    'due_date' => '2026-03-15',
                    'subtotal' => 21860.00,
                    'vat_rate' => 7.00,
                    'vat_amount' => 1530.20,
                    'discount' => 0.00,
                    'total' => 23390.20,
                    'status' => 'paid',
                    'note' => 'ชำระด้วย Transfer',
                    'items' => [
                        ['product_code' => 'P003', 'product_name' => 'โคมไฟถนน LED 100W กันน้ำ IP65', 'quantity' => 6, 'unit_price' => 2190.00, 'total' => 13140.00, 'sort_order' => 1],
                        ['product_code' => 'P011', 'product_name' => 'ไฟฉุกเฉิน LED 2 หัว 3W', 'quantity' => 8, 'unit_price' => 1090.00, 'total' => 8720.00, 'sort_order' => 2],
                    ],
                ],
                [
                    'invoice_no' => 'INV-2026-002',
                    'customer_email' => 'buy@samuttrading.co.th',
                    'customer_name' => 'หจก. สมุทรเทรดดิ้งแอนด์ซัพพลาย',
                    'customer_address' => '456 ถ.สุขุมวิท สมุทรปราการ',
                    'customer_tel' => '02-777-5678',
                    'invoice_date' => '2026-03-01',
                    'due_date' => '2026-03-31',
                    'subtotal' => 14540.00,
                    'vat_rate' => 7.00,
                    'vat_amount' => 1017.80,
                    'discount' => 500.00,
                    'total' => 15057.80,
                    'status' => 'sent',
                    'note' => 'NET 30',
                    'items' => [
                        ['product_code' => 'P001', 'product_name' => 'หลอดไฟ LED Bulb 9W E27 แสงเดย์ไลท์', 'quantity' => 120, 'unit_price' => 79.00, 'total' => 9480.00, 'sort_order' => 1],
                        ['product_code' => 'P005', 'product_name' => 'สวิตช์ไฟ 1 ทาง 16A สีขาว', 'quantity' => 60, 'unit_price' => 45.00, 'total' => 2700.00, 'sort_order' => 2],
                        ['product_code' => 'P006', 'product_name' => 'เต้ารับคู่ 3 ขา มีกราวด์', 'quantity' => 40, 'unit_price' => 59.00, 'total' => 2360.00, 'sort_order' => 3],
                    ],
                ],
                [
                    'invoice_no' => 'INV-2026-003',
                    'customer_email' => 'sasithorn@gmail.com',
                    'customer_name' => 'คุณศศิธร แสงสว่าง',
                    'customer_address' => '789 ม.5 ต.บางเขน นนทบุรี',
                    'customer_tel' => '081-234-5678',
                    'invoice_date' => '2026-03-10',
                    'due_date' => '2026-03-25',
                    'subtotal' => 7070.00,
                    'vat_rate' => 7.00,
                    'vat_amount' => 494.90,
                    'discount' => 0.00,
                    'total' => 7564.90,
                    'status' => 'paid',
                    'note' => 'ชำระเงินสด',
                    'items' => [
                        ['product_code' => 'P004', 'product_name' => 'โคมไฮเบย์ LED 150W สำหรับโกดัง', 'quantity' => 2, 'unit_price' => 2690.00, 'total' => 5380.00, 'sort_order' => 1],
                        ['product_code' => 'P009', 'product_name' => 'MCB 1P 20A 6kA', 'quantity' => 10, 'unit_price' => 169.00, 'total' => 1690.00, 'sort_order' => 2],
                    ],
                ],
                [
                    'invoice_no' => 'INV-2026-004',
                    'customer_email' => 'it@easternport.co.th',
                    'customer_name' => 'บริษัท อีสเทิร์น พอร์ต เอ็นจิเนียริ่ง จำกัด',
                    'customer_address' => '101 นิคมอุตสาหกรรม บางชัน',
                    'customer_tel' => '02-999-0001',
                    'invoice_date' => '2026-03-15',
                    'due_date' => '2026-04-14',
                    'subtotal' => 26820.00,
                    'vat_rate' => 7.00,
                    'vat_amount' => 1877.40,
                    'discount' => 0.00,
                    'total' => 28697.40,
                    'status' => 'draft',
                    'note' => 'รอการอนุมัติ',
                    'items' => [
                        ['product_code' => 'P007', 'product_name' => 'สายไฟ THW 1x2.5 sq.mm (100m)', 'quantity' => 12, 'unit_price' => 1390.00, 'total' => 16680.00, 'sort_order' => 1],
                        ['product_code' => 'P010', 'product_name' => 'ตู้คอนซูมเมอร์ยูนิต 8 ช่อง', 'quantity' => 6, 'unit_price' => 1690.00, 'total' => 10140.00, 'sort_order' => 2],
                    ],
                ],
                [
                    'invoice_no' => 'INV-2026-005',
                    'customer_email' => 'purchase@school.ac.th',
                    'customer_name' => 'โรงเรียน แหลมฉบังวิทยา',
                    'customer_address' => '50 ถ.นวลจันทร์ กรุงเทพฯ 10230',
                    'customer_tel' => '02-555-6789',
                    'invoice_date' => '2026-02-01',
                    'due_date' => '2026-03-01',
                    'subtotal' => 19820.00,
                    'vat_rate' => 7.00,
                    'vat_amount' => 1387.40,
                    'discount' => 0.00,
                    'total' => 21207.40,
                    'status' => 'overdue',
                    'note' => 'เกินกำหนดชำระ!',
                    'items' => [
                        ['product_code' => 'P002', 'product_name' => 'หลอดไฟ LED Tube T8 18W 120cm', 'quantity' => 80, 'unit_price' => 149.00, 'total' => 11920.00, 'sort_order' => 1],
                        ['product_code' => 'P012', 'product_name' => 'ปลั๊กพ่วงอุตสาหกรรม 4 ช่อง 16A', 'quantity' => 10, 'unit_price' => 790.00, 'total' => 7900.00, 'sort_order' => 2],
                    ],
                ],
            ];

            foreach ($invoices as $invoiceData) {
                $invoice = Invoice::query()->withTrashed()->firstOrNew([
                    'invoice_no' => $invoiceData['invoice_no'],
                ]);
                $invoice->fill([
                    'customer_id' => $customerMap[$invoiceData['customer_email']] ?? null,
                    'customer_name' => $invoiceData['customer_name'],
                    'customer_address' => $invoiceData['customer_address'],
                    'customer_tel' => $invoiceData['customer_tel'],
                    'customer_email' => $invoiceData['customer_email'],
                    'invoice_date' => $invoiceData['invoice_date'],
                    'due_date' => $invoiceData['due_date'],
                    'subtotal' => $invoiceData['subtotal'],
                    'vat_rate' => $invoiceData['vat_rate'],
                    'vat_amount' => $invoiceData['vat_amount'],
                    'discount' => $invoiceData['discount'],
                    'total' => $invoiceData['total'],
                    'status' => $invoiceData['status'],
                    'note' => $invoiceData['note'],
                    'paid_at' => $invoiceData['status'] === Invoice::STATUS_PAID ? $invoiceData['invoice_date'] . ' 12:00:00' : null,
                    'created_by' => $admin?->id,
                ]);
                $invoice->save();
                if ($invoice->trashed()) {
                    $invoice->restore();
                }

                InvoiceItem::query()->where('invoice_id', $invoice->id)->delete();
                foreach ($invoiceData['items'] as $itemData) {
                    InvoiceItem::query()->create([
                        'invoice_id' => $invoice->id,
                        'product_id' => $productMap[$itemData['product_code']] ?? null,
                        'product_name' => $itemData['product_name'],
                        'description' => null,
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $itemData['unit_price'],
                        'total' => $itemData['total'],
                        'sort_order' => $itemData['sort_order'],
                    ]);
                }
            }

            $movements = [
                ['product_code' => 'P003', 'type' => 'in', 'quantity' => 6, 'balance_after' => 18, 'unit_price' => 1450.00, 'reference_no' => null, 'supplier' => 'ผู้ผลิต LED Thailand', 'requester' => null, 'department' => null, 'note' => 'รับเข้าจากผู้ผลิต', 'created_at' => '2026-03-20 09:15:00'],
                ['product_code' => 'P011', 'type' => 'out', 'quantity' => 4, 'balance_after' => 21, 'unit_price' => null, 'reference_no' => 'INV-2026-001', 'supplier' => null, 'requester' => 'สมศรี มีทรัพย์', 'department' => 'ปฏิบัติการท่าเรือ', 'note' => 'ติดตั้งคลังท่าเรือ', 'created_at' => '2026-03-19 14:30:00'],
                ['product_code' => 'P001', 'type' => 'in', 'quantity' => 30, 'balance_after' => 120, 'unit_price' => 45.00, 'reference_no' => null, 'supplier' => 'บริษัท แสงไทยซัพพลาย', 'requester' => null, 'department' => null, 'note' => 'รับเข้าประจำสัปดาห์', 'created_at' => '2026-03-18 10:00:00'],
                ['product_code' => 'P007', 'type' => 'out', 'quantity' => 5, 'balance_after' => 32, 'unit_price' => null, 'reference_no' => 'INV-2026-004', 'supplier' => null, 'requester' => 'วิชัย งานดี', 'department' => 'ติดตั้ง', 'note' => 'เบิกงานติดตั้งท่าเรือ', 'created_at' => '2026-03-17 11:45:00'],
                ['product_code' => 'P012', 'type' => 'out', 'quantity' => 2, 'balance_after' => 11, 'unit_price' => null, 'reference_no' => null, 'supplier' => null, 'requester' => 'ประทีป ตั้งใจ', 'department' => 'ภาคสนาม', 'note' => null, 'created_at' => '2026-03-15 09:00:00'],
                ['product_code' => 'P006', 'type' => 'in', 'quantity' => 40, 'balance_after' => 160, 'unit_price' => 35.00, 'reference_no' => null, 'supplier' => 'หจก. สมุทรเทรดดิ้งแอนด์ซัพพลาย', 'requester' => null, 'department' => null, 'note' => null, 'created_at' => '2026-03-12 15:00:00'],
            ];

            foreach ($movements as $movementData) {
                $attributes = [
                    'product_id' => $productMap[$movementData['product_code']] ?? null,
                    'type' => $movementData['type'],
                    'quantity' => $movementData['quantity'],
                    'balance_after' => $movementData['balance_after'],
                    'created_at' => $movementData['created_at'],
                ];

                $exists = DB::table('stock_movements')->where($attributes)->exists();
                if (! $exists) {
                    DB::table('stock_movements')->insert(array_merge($attributes, [
                        'unit_price' => $movementData['unit_price'],
                        'reference_no' => $movementData['reference_no'],
                        'supplier' => $movementData['supplier'],
                        'requester' => $movementData['requester'],
                        'department' => $movementData['department'],
                        'note' => $movementData['note'],
                        'created_by' => $admin?->id,
                        'updated_at' => $movementData['created_at'],
                    ]));
                }
            }
        });
    }
}
