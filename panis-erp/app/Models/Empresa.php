<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';

    public function dono() {
        return $this->belongsTo(User::class, 'id_dono');
    }

    public function lojas() {
        return $this->hasMany(Loja::class, 'id_empresa');
    }
}
