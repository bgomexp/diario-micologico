<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    /**
     * Relación con las entradas
     */
    public function entradas() : BelongsToMany
    {
        return $this->belongsToMany(Entrada::class);
    }
}
