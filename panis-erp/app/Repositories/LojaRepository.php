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

    public function update(Loja $loja) {
        $loja->save();
    }

    public function getLoja(int $id) {
        return Loja::where('id', $id)->first()->load(['dono']);
    }

    public function getAllLojas() {
        return Loja::with(['dono']);
    }

    public function getAllLojasVinculadas(User $userLogado) {
        return $userLogado->load(['lojas'])->lojas;
    }

}