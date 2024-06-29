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
      Schema::create('invoice_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('invoice_id');
        $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        $table->string('item');
        $table->integer('quantity');
        $table->decimal('unit_rate', 10, 2);
        $table->decimal('cgst', 8, 2);
        $table->decimal('sgst', 8, 2);
        $table->decimal('igst', 8, 2);
        $table->decimal('amount', 10, 2);
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};