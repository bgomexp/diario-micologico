<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    /**
     * Relación con los usuarios
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
