<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'numeroFactura',
        'referenciaPago',
        'valor',
        'valorVencido',
        'periodoCancelar',
        'fechaLimitePago'
    ];

    public function pagos(): HasMany {
        return $this->hasMany(Pago::class);
    }

}
