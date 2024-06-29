<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
          $table->id();
          $table->string('invoice_no');
          $table->date('date');
          $table->string('placeSupply');
          $table->string('billName');
          $table->string('billingAddress');
          $table->string('billingPhoneNo');
          $table->string('billingEmail');
          $table->string('shipName');
          $table->string('shipAddress');
          $table->string('shipPhoneNo');
          $table->string('shipEmail');
          $table->text('phoneNumber');
          $table->text('emailAddress');
          $table->decimal('subTotal', 10, 2);
          $table->decimal('discountInput', 10, 2);
          $table->decimal('discountValue', 10, 2);
          $table->decimal('netAmount', 10, 2);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};