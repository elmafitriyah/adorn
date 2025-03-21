<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $fillable = ['product', 'description', 'price', 'stock', 'id_category', 'image'];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'id_product', 'id_product');
    }
    
}
