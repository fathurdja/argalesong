<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekanan extends Model
{
    protected $table = 'rekanan';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id_rekanan';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'id_rekanan',
        'name',
        'address',
        'phone',
        'email',
    ];
}
