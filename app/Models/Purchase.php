<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchases';
    protected $primaryKey = 'id_purchase';
    protected $fillable = ['id_supplier','purchase_date', 'total_price'];
    public $timestamps = false;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }
}
