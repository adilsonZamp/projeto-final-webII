<?php

namespace App\Repositories;

use App\Models\User;


class DonoRepository {
    public function listarFuncionarios(User $dono) {
        $gerentes = User::with(['perfil', 'responsavel'])->where('id_responsavel', '=', $dono->id)->get();
        $funcionarios = User::with(['perfil', 'responsavel'])->whereIn('id_responsavel', $gerentes->pluck('id')->toArray())->get();
        
        return $funcionarios->concat($gerentes);
    }
}