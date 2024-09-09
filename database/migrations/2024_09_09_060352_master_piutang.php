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
        Schema::create('masterPiutang', function (Blueprint $table) {
            $table->id();
            $table->char('idpelanggan', 15);
            $table->decimal('tagihan', 15, 2);
            $table->decimal('totaldiskon', 15, 2);
            $table->decimal('ppn', 15, 2);
            $table->decimal('totalpiutang', 17, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masterPiutang');
    }
};
