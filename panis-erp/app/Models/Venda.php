<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = ['valor', 'id_loja', 'data_referencia'];
    public function loja() {
        return $this->belongsTo(Loja::class, 'id_loja');
    }
}
