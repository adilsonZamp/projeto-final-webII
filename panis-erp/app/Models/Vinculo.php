<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    //fazer vinculo de gerentes e funcionarios as lojas (pode ser mais de uma para cada um)
    protected $table = 'loja_user';
    protected $fillable = ['user_id', 'loja_id'];

    public function funcionario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function loja() {
        return $this->belongsTo(Loja::class, 'loja_id');
    }
}
