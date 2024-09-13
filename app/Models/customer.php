<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    // Define the table name if it's different from the plural of the model name
    protected $table = 'customer';

    // Define which attributes are mass assignable
    protected $fillable = [
        'id_Pelanggan',
        'name',
        'ktp',
        'npwp',
        'alamat',
        'email',
        'whatsapp',
        'telepon',
        'kota',
        'kode_pos',
        'provinsi',
        'notes',
        'idtypepelanggan',
        'fax',
        'sharing',
    ];

    public function tipePelanggan()
    {
        return $this->belongsTo(TipePelanggan::class, 'idtypepelanggan', 'kodeType');
    }

    public function tipePiutang()
    {
        return $this->belongsTo(TipePiutang::class, 'idtypepiutang', 'kodePiutang');
    }

    public function piutang()
    {
        return $this->hasMany(Piutang::class, 'idpelanggan', 'id_Pelanggan');
    }
}
