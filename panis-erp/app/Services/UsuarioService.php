<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UsuarioRepository;

class UsuarioService 
{
    public function __construct(
        private UsuarioRepository $repository
    ) {}
    //regras de negócio sem depender de coisas externas
    //chamar repository para salvar
    public function inserir(User $usuario) {
        return $this->repository->inserir($usuario);
    }
}
