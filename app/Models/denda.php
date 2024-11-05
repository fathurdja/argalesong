<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class denda extends Model
{
    use HasFactory;
    protected $table = 'denda';
    protected $fillable = [
        'idpelanggan',
        'nominal',
        'piutang'
    ];
}
