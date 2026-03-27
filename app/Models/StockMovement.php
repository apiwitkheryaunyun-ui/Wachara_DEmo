<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    protected $fillable = [
        'product_id', 'type', 'quantity', 'balance_after',
        'unit_price', 'reference_no', 'supplier',
        'requester', 'department', 'note', 'created_by',
    ];

    protected $casts = [
        'quantity'      => 'integer',
        'balance_after' => 'integer',
        'unit_price'    => 'decimal:2',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeStockIn($query)
    {
        return $query->where('type', 'in');
    }

    public function scopeStockOut($query)
    {
        return $query->where('type', 'out');
    }
}
