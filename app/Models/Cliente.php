<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipoDocumentoIdentidad',
        'numeroDocumentoIdentidad',
        'nombre',
        'telefonoContacto',
        'email',
        'direccionCorrespondencia'
    ];

    public function invoices(): HasMany {
        return $this->hasMany(Invoice::class);
    }

}
