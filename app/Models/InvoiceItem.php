<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = ['item', 'description' , 'quantity', 'unit_rate', 'cgst', 'sgst', 'igst', 'amount'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}