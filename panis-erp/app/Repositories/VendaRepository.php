<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Venda;

class VendaRepository {
    public function inserir(Venda $data) {
        if ($data->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllVendasUser(User $userLogado) {
        $resposta = Venda::with(['loja'])->whereIn('id_loja', $userLogado->lojas->pluck('id')->toArray())->get();

        // dd($resposta);

        return $resposta;
    }

}