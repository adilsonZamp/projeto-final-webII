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

    public function getAllDonos() {
        return User::with(['perfil'])->where('id_perfil', '=', 1)->get();
    }

    public function destroy(User $user) {
        return $user->delete();
    }

    public function update(User $novo) {
        // dd($novo);
        return $novo->save();
    }

    public function getUsuarioPorId(int $id) {
        return User::find($id);
    }

    //pedaço de PerfilRepository
    public function getPerfis() {
        return Perfil::get();
    }
    public function getAllPerfisCadastro() {
        return Perfil::whereNotIn('id', [0, 1])->get();
    }

    public function listarFuncionarios(User $dono) {
        $gerentes = User::with(['perfil', 'responsavel'])->where('id_responsavel', '=', $dono->id)->get();
        $funcionarios = User::with(['perfil', 'responsavel'])->whereIn('id_responsavel', $gerentes->pluck('id')->toArray())->get();
        
        return $funcionarios->concat($gerentes);
    }
    public function listarGerentes(User $dono) {
        $gerentes = User::with(['perfil', 'responsavel'])->where('id_responsavel', '=', $dono->id)->get();
        
        return $gerentes;
    }
}