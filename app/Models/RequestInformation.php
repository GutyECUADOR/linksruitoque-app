<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'requestId',
        'referencia',
        'status',
        'date',
        'valorTotal',
        'moneda'
    ];

    public function getStatusMessageAttribute()
    {
        return match ($this->status) {
            'PENDING' => 'Tu pago está siendo procesado, espera unos minutos mientras tu entidad financiera valida el pago',
            'REJECTED' => 'Tu pago ha sido rechazado, consulta con tu entidad financiera.',
            'APPROVED' => 'Gracias por tu pago.',
            default => 'Estado desconocido, contacte a soporte.',
        };
    }
}
