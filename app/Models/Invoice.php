<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_no', 'date', 'placeSupply', 'subTotal', 'discountInput','discountValue', 'netAmount', 'phoneNumber', 'emailAddress','billName','billingAddress', 'billingPhoneNo', 'billingEmail', 'shipName', 'shipAddress', 'shipPhoneNo', 'shipEmail',];

  public function items()
  {
      return $this->hasMany(InvoiceItem::class);
  }

  protected static function booted()
    {
        static::deleting(function ($invoice) {
            $invoice->items()->delete();
        });
    }

}