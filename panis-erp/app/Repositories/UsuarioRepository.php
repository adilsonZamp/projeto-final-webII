<?php

namespace App\Repositories;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Support\Facades\DB; 

class UsuarioRepository {
    public function inserir(User $user) {
        $user->save();
    }
    public function getAllUsuarios() {
        return User::with(['perfil'])->get();
    }

    public function getUsuarioPorId(int $id) {
        return User::find($id);
    }

    //pedaço de PerfilRepository
    public function getAllPerfis() {
        return Perfil::where('id', '!=', 0)->get();
    }

}