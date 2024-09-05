<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JatuhTempo extends Model
{
    use HasFactory;
    protected $table = 'jatuh_tempos';
    protected $fillable = ['name'];
    public $timestamps = true;
    protected $primaryKey = 'id';
    
}
