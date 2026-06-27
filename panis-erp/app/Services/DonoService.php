<?php

namespace App\Services;

use App\Models\Loja;
use App\Models\User;
use App\Repositories\DonoRepository;


class DonoService 
{
    public function __construct(
        private DonoRepository $repository
    ) {}
    //regras de negócio sem depender de coisas externas
    //chamar repository para salvar
    public function listarFuncionarios(User $donoLogado) {
        return $this->repository->listarFuncionarios($donoLogado);
    }
    public function listarGerentes(User $donoLogado) {
        return $this->repository->listarGerentes($donoLogado);
    }
}
