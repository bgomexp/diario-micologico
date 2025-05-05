<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Especie extends Model
{
    
    use HasFactory;

    /**
     * Relación con las entradas
     */
    public function entradas() : BelongsToMany
    {
        return $this->belongsToMany(Entrada::class);
    }
}
