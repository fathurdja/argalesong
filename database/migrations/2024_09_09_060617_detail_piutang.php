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
        Schema::create('detailPiutang', function (Blueprint $table) {
            $table->id();
            $table->char('idpelanggan', 15);
            $table->date('tgltra');
            $table->char('idtra', 15);
            $table->date('tgl_jatuh_tempo');
            $table->integer('jhari');
            $table->decimal('nominal', 15, 2);
            $table->decimal('ppn', 15, 2);
            $table->decimal('diskon', 15, 2);
            $table->char('kodepiutang', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailPiutang');
    }
};
