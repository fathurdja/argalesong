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
        Schema::create('pembayaranPiutang', function (Blueprint $table) {
            $table->char('idpelanggan', 15); // Char 15 for customer ID
            $table->char('idtrx', 15); // Char 15 for transaction ID
            $table->date('tglbayar'); // Date for payment date
            $table->decimal('tagihan', 15, 2); // Decimal 15,2 for billing amount
            $table->char('modebayar', 5); // Char 5 for payment mode (KAS/BANK)
            $table->decimal('diskon', 12, 2)->nullable(); // Nullable decimal 12,2 for discount
            $table->decimal('nominalbayar', 15, 2); // Decimal 15,2 for amount paid
            $table->mediumText('keterangan')->nullable(); // MediumText for additional notes, nullable

            // Add unique index for idtrx + idpelanggan
            $table->unique(['idtrx', 'idpelanggan']);

            // // Add foreign key constraints if necessary
            // $table->foreign('idtrx')->references('idtra')->on('detailpiutang'); // If the idtrx refers to a foreign table
            // $table->foreign('idpelanggan')->references('id_Pelanggan')->on('customer'); // If the idtrx refers to a foreign table

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaranPiutang');
    }
};
