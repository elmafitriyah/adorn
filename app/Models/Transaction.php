<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $primaryKey = 'id_transaction';
    protected $fillable = [ 'transaction_date', 'total_price'];
    public $timestamps = false;

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'id_transaction', 'id_transaction');
    }
}
