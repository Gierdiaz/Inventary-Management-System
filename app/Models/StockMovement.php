<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'type',
        'date',
        'note',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected $table = 'stock_movements';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
