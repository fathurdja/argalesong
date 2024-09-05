<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LewatPlafon extends Model
{
    use HasFactory;
    protected $table = 'lewat_plafons';
    protected $fillable = ['name'];
    public $timestamps = true;
    protected $primaryKey = 'id';
}
