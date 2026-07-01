<?php

namespace App\Repositories;

use App\Models\Loja;
use App\Models\User;

class LojaRepository {
    public function inserir(Loja $data) {
        $data->save();
    }

    public function delete(Loja $loja) {
        $loja->delete();
    }

    public function getAllLojas() {
        return Loja::all()->load(['dono']);
    }

    public function getAllLojasVinculadas(User $userLogado) {
        return $userLogado->load(['lojas'])->lojas;
    }

}