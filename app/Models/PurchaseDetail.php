<?php

namespace App\Models;

use App\Http\Controllers\ProductController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseDetail extends Model
{
    protected $table = 'purchase_details';
    protected $primaryKey = 'id_purchase_detail';
    protected $fillable = ['id_purchase', 'id_product', 'quantity', 'unit_price'];
    public $timestamps = false;

    public function purchase() {
        return $this->belongsTo(Purchase::class, 'id_purchase', 'id_purchase');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
