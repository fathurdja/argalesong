<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePiutang extends Model
{
    use HasFactory;
    protected $table = 'tipepiutang';
    protected $fillable = ['name', 'kodePiutang'];


    public function customers()
    {
        return $this->hasMany(Customer::class, 'idtypepiutang', 'kodePiutang');
    }
}
