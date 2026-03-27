<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_no', 'customer_id', 'customer_name',
        'customer_address', 'customer_tel', 'customer_email',
        'invoice_date', 'due_date',
        'subtotal', 'vat_rate', 'vat_amount', 'discount', 'total',
        'status', 'note', 'paid_at', 'created_by',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date'     => 'date',
        'paid_at'      => 'datetime',
        'subtotal'     => 'decimal:2',
        'vat_rate'     => 'decimal:2',
        'vat_amount'   => 'decimal:2',
        'discount'     => 'decimal:2',
        'total'        => 'decimal:2',
    ];

    const STATUS_DRAFT   = 'draft';
    const STATUS_SENT    = 'sent';
    const STATUS_PAID    = 'paid';
    const STATUS_OVERDUE = 'overdue';
    const STATUS_CANCELLED = 'cancelled';

    // ========= Relationships =========

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class)->orderBy('sort_order');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ========= Scopes =========

    public function scopePaid($query)
    {
        return $query->where('status', self::STATUS_PAID);
    }

    public function scopeUnpaid($query)
    {
        return $query->whereIn('status', [self::STATUS_SENT, self::STATUS_OVERDUE]);
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', self::STATUS_OVERDUE);
    }

    // ========= Helpers =========

    public function recalculateTotals(): void
    {
        $subtotal = $this->items->sum('total');
        $vatAmount = $subtotal * ($this->vat_rate / 100);
        $this->subtotal   = $subtotal;
        $this->vat_amount = $vatAmount;
        $this->total      = $subtotal + $vatAmount - $this->discount;
        $this->save();
    }

    public function isOverdue(): bool
    {
        return $this->status !== self::STATUS_PAID
            && $this->due_date->isPast();
    }

    public static function generateInvoiceNo(): string
    {
        $year  = now()->format('Y');
        $last  = static::whereYear('created_at', $year)->max('invoice_no');
        $seq   = $last ? (int) substr($last, -3) + 1 : 1;
        return 'INV-' . $year . '-' . str_pad($seq, 3, '0', STR_PAD_LEFT);
    }
}
