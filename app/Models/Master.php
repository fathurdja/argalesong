<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    protected $table = 'dummy_masters';

    protected $fillable = [
        'nomor_bukti',
        'vendor',
        'tanggal_trans',
        'tanggal_exp',
        'harga',
    ];
}
