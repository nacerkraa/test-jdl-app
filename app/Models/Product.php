<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;
use App\Models\Warehouse;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'in_stock',
        'status',
        'category_id',
        'warehouse_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'in_stock' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
