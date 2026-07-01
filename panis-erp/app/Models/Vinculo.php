<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    //fazer vinculo de gerentes e funcionarios as lojas (pode ser mais de uma para cada um)
    protected $table = 'vinculo_loja';
    protected $fillable = ['id_funcionario', 'id_loja'];

    public function funcionario() {
        return $this->belongsTo(User::class, 'id_funcionario');
    }

    public function loja() {
        return $this->belongsTo(Loja::class, 'id_loja');
    }
}
