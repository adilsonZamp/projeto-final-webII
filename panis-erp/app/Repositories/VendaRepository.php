<?php

namespace App\Repositories;

use App\Models\Loja;
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

    public function getAllVendasDono(User $donoLogado) {
        return $donoLogado->load(['vendas'])->vendas;
    }
    public function getAllVendasFuncionario(User $funcionarioLogado) {
        return Venda::whereIn('id_loja', $funcionarioLogado->lojas->pluck('id')->toArray());
    }
}