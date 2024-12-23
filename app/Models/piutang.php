<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class piutang extends Model
{
    protected $table = 'detailpiutang';

    protected $fillable = [
        'idpelanggan',
        'tgltra',
        'tgl_jatuh_tempo',
        'jhari',
        'dpp',
        'nominal',
        'ppn',
        'pph',
        'pajak',
        'diskon',
        'kodepiutang',
        'no_invoice',
        'jenisTagihan',
        'jumlahTagihan',
        'urutanTagihan',
        'statusPembayaran'

    ];
    public function pelanggan()
    {
        return $this->belongsTo(customer::class, 'idpelanggan', 'id_Pelanggan');  // assuming 'id' is the primary key in 'pelanggan'
    }

    /**
     * Relasi dengan tabel Master Pajak.
     * Setiap piutang mempunyai satu jenis pajak.
     */
    public function pajak()
    {
        return $this->belongsTo(masterDataPajak::class, 'pajak', 'kodePajak');  // assuming 'id' is the primary key in 'masterpajak'
    }

    /**
     * Relasi dengan tabel Piutang.
     * Setiap transaksi mempunyai satu jenis piutang.
     */
    public function jenisPiutang()
    {
        return $this->belongsTo(TipePiutang::class, 'kodepiutang', 'kodePiutang');  // assuming 'id' is the primary key in 'piutang'
    }

    public static function getDetailPiutang($nomor_invoice)
    {
        Log::info("Querying detail piutang for invoice number: " . $nomor_invoice);
        return self::with(['pelanggan', 'pajak', 'jenisPiutang'])
            ->where('no_invoice', $nomor_invoice)
            ->first();
    }
    public function piutangBerulang()
    {
        return $this->hasMany(Piutang::class, 'no_invoice', 'no_invoice')
            ->where('id', '!=', $this->id);
    }
}
