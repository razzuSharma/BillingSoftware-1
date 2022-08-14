<?php

namespace App\Models;
use App\Models\Purchaseitem;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'product_detail_id',
        'quantity',
        'rate',
        'amount',
        'discount',
        'profit_per_item',
        'total_profit',
    ];

    public function purchaseitem()
    {
        return $this->belongsTo(PurchaseItem::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class);
    }
}
