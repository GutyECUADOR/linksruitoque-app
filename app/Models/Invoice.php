<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numeroFactura',
        'referenciaPago',
        'valor',
        'valorVencido',
        'periodoCancelar',
        'fechaLimitePago'
    ];
}
