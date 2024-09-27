<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class piutang extends Model
{
    protected $table = 'detailpiutang';

    protected $fillable = [
        'idpelanggan',
        'tgltra',
        'tgl_jatuh_tempo',
        'jhari',
        'nominal',
        'ppn',
        'pajak',
        'diskon',
        'kodepiutang',
        'no_invoice',

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
}
