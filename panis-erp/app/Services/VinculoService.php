<?php

namespace App\Services;

use App\Models\Loja;
use App\Models\User;
use App\Models\Vinculo;
use App\Repositories\LojaRepository;
use App\Repositories\VinculoRepository;

class VinculoService 
{
    public function __construct(
        private VinculoRepository $repository
    ) {}
    //regras de negócio sem depender de coisas externas
    //chamar repository para salvar
    public function inserir(Vinculo $vinculo) {
        return $this->repository->inserir($vinculo);
    }

    public function getAllVinculosVisiveis(User $userLogado) {
        if ($userLogado->perfil->descricao == 'Dono') {
            return $this->repository->getAllVinculosDono($userLogado);
        } else if ($userLogado->perfil->descricao == 'Gerente') {
            return $this->repository->getAllVinculosDono($userLogado);
        }
    }
}
