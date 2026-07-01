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
    public function inserir(int $idUser, int $idLoja) {
        return $this->repository->inserir(new Vinculo(['id_funcionario' => $idUser, 'id_loja' => $idLoja]));
    }
}
