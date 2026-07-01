<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Vinculo;

class VinculoRepository {
    public function inserir(Vinculo $data) {
        $data->save();
    }

    // public function getAllVinculosFuncionario(User $userLogado) {
    //     return Vinculo::where('id_funcionario', '=', $userLogado->id)->get();
    // }

    public function getAllVinculosDono(User $donoLogado) {
        // dd($donoLogado->lojasDono->toArray());
        // dd($donoLogado->lojasDono->pluck('id')->toArray());
        // dd(Vinculo::whereIn('loja_id', $donoLogado->lojasDono->pluck('id')->toArray())->get());
        return Vinculo::whereIn('loja_id', $donoLogado->lojasDono->pluck('id')->toArray())->get();
    }
}