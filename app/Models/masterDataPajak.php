<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masterDataPajak extends Model
{
    use HasFactory;
    protected $table = 'masterdatapajak';
    protected $fillable = [
        'name',
        'kode_pajak',
        'nilai',
        'created_at'
    ];
}
