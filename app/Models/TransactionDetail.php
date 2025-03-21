<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $table = 'transaction_details';
    protected $primaryKey = 'id_transaction_detail';
    protected $fillable = ['id_transaction', 'id_product', 'quantity'];
    public $timestamps = false;

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaction', 'id_transaction');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
