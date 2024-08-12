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
        Schema::create('dummy_masters', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_bukti')->unique();
            $table->string('vendor');
            $table->date('tanggal_trans');
            $table->date('tanggal_exp');
            $table->decimal('harga', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dummy_masters');
    }
};
