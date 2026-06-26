<?php

namespace App\Services;

use App\Models\Loja;
use App\Repositories\LojaRepository;

class LojaService 
{
    public function __construct(
        private LojaRepository $repository
    ) {}
    //regras de negócio sem depender de coisas externas
    //chamar repository para salvar
    public function inserir(Loja $data) {
        return $this->repository->inserir($data);
    }
}
