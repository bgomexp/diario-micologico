<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Entrada extends Model
{
    /**
     * Relación con los usuarios
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con las especies
     */
    public function especies() : BelongsToMany
    {
        return $this->belongsToMany(Especie::class, "entrada_especie", "entrada_id", "especie_id")
                    ->withPivot('cantidad');
    }
}
