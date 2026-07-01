<?php

namespace App\Services;

use App\Models\User;
use App\Models\Venda;
use App\Repositories\LojaRepository;
use App\Repositories\VendaRepository;

class vendaService 
{
    public function __construct(
        private VendaRepository $repository,
    ) {}
    //regras de negócio sem depender de coisas externas
    //chamar repository para salvar
    public function inserir(Venda $data, User $userLogado) {
        // dd($data->id_loja,$userLogado->lojas->pluck('id')->toArray());
        //novos usuários tem o problema de não terem vínculo, ajustar cadastro ;-;
        if (in_array($data->id_loja, $userLogado->lojas->pluck('id')->toArray()) || $data->loja->id_dono == $userLogado->id) {
            // dd($data);
            return $this->repository->inserir($data);
        } else {
            return null;
        }
    }

    public function getAllVendasUser(User $userLogado) {
        if ($userLogado->perfil->descricao == 'Dono') {
            return $this->repository->getAllVendasDono($userLogado);
        } else {
            return $this->repository->getAllVendasFuncionario($userLogado);
        }
    }
}
