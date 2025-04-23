<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encontrado extends Model
{
    protected $table = "encontrados";

    /**
     * Relación con las especies
     */
    public function especie()
    {
        return $this->belongsTo(Especie::class);
    }

    /**
     * Relación con las entradas
     */
    public function entrada()
    {
        return $this->belongsTo(Entrada::class);
    }
}
