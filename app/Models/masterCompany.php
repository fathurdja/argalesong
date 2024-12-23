<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masterCompany extends Model
{
    protected $table = 'masterCompany';
    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'company_id',
        'code',
        'name',
        'business',
        'image',
    ];

    public function companyid()
    {
        return $this->hasMany(customer::class, 'company_id', 'idcompany');
    }
}
