<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $primaryKey = 'id_supplier';
    protected $fillable = ['supplier', 'supplier_address', 'phone_number'];
    public $timestamps = false;
}
